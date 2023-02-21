<?php
use Kirby\Http\Header;
use Kirby\Filesystem\F;

return function ($kirby, $target) {
  if ($kirby->request()->is('POST')) {

    // check the honeypot and exit if it has been filled in
    if (empty(get('website')) === false) {
      go($page->url());
      exit;
    }

    $targetPage = $kirby->page($target);

    // check if target page exists
    if (!$targetPage) {
      Header::status(400);
      exit;
    }

    // check if content of target page is downloadable
    if ($targetPage->downloadable()->toBool() === false) {
      Header::status(403);
      exit;
    }

    $uploads = $kirby->request()->files()->get('uploadFile');;

    $blueprintName = strtolower($targetPage->intendedTemplate());

    // ensure uploads is an array
    if (isset($uploads['name'])) {
      $uploads = [$uploads];
    }

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
      $blueprintName === 'ext_album' &&
      !empty($imagesPath = $targetPage->album_images_path())
    ) {
      $imagesPath = $imagesPath->replacePathVars();

      // images path is relative to servers document root
      $imagesPath = $_SERVER['DOCUMENT_ROOT'] . $imagesPath;

      if (!file_exists($imagesPath)) {
        // TODO error handling
        error_log("Images path $imagesPath does not exist.");
        exit;
      }

      // fetch existing media files
      $existingFiles = array_filter(scandir($imagesPath), function ($file) use ($imagesPath) {
        $fileExtension = pathinfo("$imagesPath/$file", PATHINFO_EXTENSION);
        return in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'webm', 'mov', 'mpeg', 'mpeg2', 'avi']);
      });

      foreach ($uploads as $upload) {
        // check for duplicate
        $duplicates = array_filter($existingFiles, function ($filename) use ($imagesPath, $upload) {
          // get original safename without prefix
          $originalSafename = $filename;
          if (strpos($filename, 'upload') === 0) {
            $pos              = strpos($filename, '_');
            $originalSafename = substr($originalSafename, $pos + 1);
          }

          return
            $originalSafename === F::safeName($upload['name']) &&
            mime_content_type("$imagesPath/$filename") === $upload['type'] &&
            filesize("$imagesPath/$filename") === $upload['size'];
        });

        if (count($duplicates) > 0) {
          Header::status(400);
          $filename = $upload['name'];
          $alert = "Die Datei $filename existiert bereits.";
          break;
        }

        try {
          $name = 'upload' . crc32($upload['name'] . microtime()) . '_' . F::safeName($upload['name']);
          move_uploaded_file($upload['tmp_name'], "$imagesPath/$name");
        } catch (Exception $e) {
          $alert = 'Error on ' . $upload['name'] . ': ' .$e->getMessage();
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
