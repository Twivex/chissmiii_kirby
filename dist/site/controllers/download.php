<?php
use Kirby\Http\Header;

return function ($kirby, $target) {
  if ($kirby->request()->is('GET')) {
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

    $blueprintName = strtolower($targetPage->intendedTemplate());

    $slug = $targetPage->slug();
    $tmpDir = $_SERVER['DOCUMENT_ROOT'] . '/tmp/';
    if (!file_exists($tmpDir)) {
      mkdir($tmpDir, 0775, true);
    }
    chdir($tmpDir);
    $zipname = "chissmiii-$slug.zip";
    $zip = new ZipArchive();
    $zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE);

    if ($blueprintName === 'album') {
      foreach ($targetPage->files() as $file) {
        $zip->addFile($file->realpath(), $file->filename());
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
        exit;
      }

      foreach(scandir($imagesPath) as $file) {
        if (preg_match("/\.([jpg|jpeg|png|gif|mp4|webm|mov|mpeg|mpeg2|avi])$/i", $file)) {
          $zip->addFile($imagesPath . '/' . $file, $file);
        }
      }
    }

    $zip->close();

    // prepare response
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=\"".$zipname."\"");
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".filesize($tmpDir.$zipname));
    ob_end_flush();

    // send file
    readfile($tmpDir.$zipname);

    // delete file
    unlink($tmpDir.$zipname);
  }
};