<?php
use Kirby\Http\Header;
use Kirby\Filesystem\F;

return function ($kirby, $target) {
  $request = $kirby->request();
  if ($request->is('POST')) {

    // check the honeypot and exit if it has been filled in
    if (empty($request->get('website')) === false) {
      go($kirby->page()->url());
      exit;
    }

    $targetPage = $kirby->page($target);

    // check if target page exists
    if (!$targetPage) {
      Header::status(400);
      exit;
    }

    // check if content of target page is downloadable
    if ($targetPage->uploadable()->toBool() === false) {
      Header::status(403);
      exit;
    }

    $uploads = $request->files()->get('uploadFile');

    $blueprintName = strtolower($targetPage->intendedTemplate());

    if ($blueprintName === 'album') {
      // authenticate as almighty
      $kirby->impersonate('kirby');

      foreach ($uploads as $upload) {
        // check for duplicate
        $files      = $targetPage->files();
        $duplicates = $files->filter(function ($file) use ($upload) {
          // get original safename without prefix
          $pos              = strpos($file->filename(), '_');
          $originalSafename = substr($file->filename(), $pos + 1);
          $originalMimeType = $file->mime();
          $originalSize = $file->size();
          $uploadSafename = F::safeName($upload['name']);
          $uploadMimeType = $upload['type'];
          $uploadSize = $upload['size'];

          return
            $originalSafename === $uploadSafename &&
            $originalMimeType === $uploadMimeType &&
            $originalSize === $uploadSize;
        });

        try {
          $name = crc32($upload['name'].microtime()). '_' . $upload['name'];
          $albumImages = $targetPage->album_images();
          $file = $targetPage->createFile([
            'source'   => $upload['tmp_name'],
            'filename' => $name,
            'template' => 'blocks/image',
            // 'content' => [
            //     'date' => date('Y-m-d h:m')
            // ]
          ]);
          // FIXME this does not work. the images need to be added to the album_images field
          $files = $albumImages->images()->files()->toArray();
          array_push($files, "\/\/" . $file->uid());
          // return compact('albumImages');
          $updatedTargetPage = $targetPage->update([
            'album_images' => $albumImages
          ]);
          $updatedTargetPage->save();
        } catch (Exception $e) {
          $alert[$upload['name']] = $e->getMessage();
        }
      }
    } elseif (
      $blueprintName === 'ext_album' || $blueprintName === 'ext_album2' &&
      !empty($albumPath = $targetPage->album_path())
    ) {
      $albumPath = $targetPage->getAlbumPath(true);

      if (!is_dir($albumPath)) {
        $albumPathCreated = mkdir($albumPath, 0775, true);
        if (!$albumPathCreated) {
          Header::status(400);
          error_log("Album path $albumPath could not be created.");
          exit;
        }
      }

      // fetch existing media files
      // $existingFiles = array_filter(scandir($albumPath), function ($file) use ($albumPath) {
      //   $fileExtension = pathinfo("$albumPath/$file", PATHINFO_EXTENSION);
      //   return in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'webm', 'mov', 'mpeg', 'mpeg2', 'avi']);
      // });

      // if (count($uploads) > 20) {
      //   Header::status(400);
      //   $alert = 'Du kannst maximal 20 Dateien auf einmal hochladen.';
      // }

      foreach ($uploads as $upload) {
        // check for duplicate
        // $duplicates = array_filter($existingFiles, function ($filename) use ($albumPath, $upload) {
        //   // get original safename without prefix
        //   $originalSafename = $filename;
        //   if (strpos($filename, 'upload') === 0) {
        //     $pos              = strpos($filename, '_');
        //     $originalSafename = substr($originalSafename, $pos + 1);
        //   }

        //   return
        //     $originalSafename === F::safeName($upload['name']) &&
        //     mime_content_type("$albumPath/$filename") === $upload['type'] &&
        //     filesize("$albumPath/$filename") === $upload['size'];
        // });

        // if (count($duplicates) > 0) {
        //   Header::status(400);
        //   $filename = $upload['name'];
        //   $alert = "Die Datei $filename existiert bereits.";
        //   break;
        // }
        $contentRange = $request->header('Content-range');
        [$format, $contentRange] = explode(' ', $contentRange);
        [$start, $contentRange] = explode('-', $contentRange);
        [$end, $fileSize] = explode('/', $contentRange);
        $fileName = $request->get('filename');
        $chunks = $request->get('chunks');
        $chunk = $request->get('chunk');
        echo var_export(compact('uploads', 'chunk','chunks', true));
        exit;

        $name = 'upload' . crc32($fileName . microtime()) . '_' . F::safeName($fileName);
        $filePath = $albumPath . '/' . $name;
        $partFilePath = $filePath . '.part';
        try {
          $out = fopen($partFilePath, $chunk === 0 ? 'wb' : 'ab');
          if ($out) {
            // Read binary input stream and append it to temp file
            $in = fopen($upload['tmp_name'], "rb");

            if ($in) {
              while ($buff = fread($in, 4096))
                fwrite($out, $buff);
            } else {
              $alert = 'Datei konnte nicht hochgeladen werden.';
            }

            fclose($in);
            fclose($out);

            unlink($upload['tmp_name']);
          } else {
            $alert = 'Datei konnte nicht hochgeladen werden.';
          }
        } catch (Exception $e) {
          $alert = 'Error on ' . $upload['name'] . ': ' .$e->getMessage();
        }
        if ($chunk < $chunks - 1) {
          $response = new \Kirby\Cms\Response('', null, '100', [
            'Cache-Expires' => '600000',
          ]);
          return $response->send();
        } else {
          if (empty($alert)) {
            // Strip the temp .part suffix off
            Header::status(200);
            rename($partFilePath, $filePath);
          } else {
            unlink($partFilePath);
          }
        }
      }
    }

    if (empty($alert)) {
      $success = 'Vielen Dank für deinen Upload!';
    }

    return [
      'error' => $alert ?? false,
      'form_data' => $data ?? null,
      'success' => $success ?? false,
    ];
  }
};
