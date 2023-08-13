<?php
use Kirby\Http\Header;
use Kirby\Http\Response;

return function ($file, $width = null, $height = null) {

  function isVideoFile($filepath) {
    return
      in_array(
        strtolower(pathinfo($filepath, PATHINFO_EXTENSION)),
        ['mp4', 'mov', 'webm', 'mpeg']
      );
  }

  function createThumbnailImage($file, $width = null, $height = null, $returnFile = false) {
    $filepath = ltrim($file, '/');
    if (isVideoFile($filepath)) {
      $filename = pathinfo($filepath, PATHINFO_FILENAME);
      $pathToFile = dirname($filepath);
      $filepath = $pathToFile . '/' . $filename . '.jpg';
    }
    $thumbnailFilepath = $_SERVER['DOCUMENT_ROOT'] . option('thumbnail_path') . '/' . $filepath;
    if ($width || $height) {
      $thumbnailOriginalFilepath = $thumbnailFilepath;
      $thumbnailFileExtension = pathinfo($thumbnailFilepath, PATHINFO_EXTENSION);
      $thumbnailFilepath = str_replace(
        '.' . $thumbnailFileExtension,
        '_' . $width . 'x' . $height . '.' . $thumbnailFileExtension,
        $thumbnailFilepath
      );
    }

    // requested file already exists -> return it
    if (file_exists($thumbnailFilepath)) {
      if ($returnFile) {
        echo Response::file($thumbnailFilepath);
      }
      return;
    }

    // ensure thumbnail directory exists
    $thumbnailDirpath = dirname($thumbnailFilepath);
    if (!is_dir($thumbnailDirpath)) {
      $thumbnailDirpathCreated = mkdir($thumbnailDirpath, 0775, true);
      if (!$thumbnailDirpathCreated) {
        Header::status(400);
        error_log("Directory $thumbnailDirpath could not be created.");
        exit;
      }
    }

    if (($width || $height)) {
      if (!file_exists($thumbnailOriginalFilepath)) {
        // create original thumbnail to keep required resources low
        createThumbnailImage($file);
      }
      // go on with the original thumbnail as source
      $filepath = $thumbnailOriginalFilepath;
    }

    if (isVideoFile($filepath)) {
      // prepare paths to create thumbnail from video
      $videoPath = $_SERVER['DOCUMENT_ROOT'] . '/' . $filepath;
      $videoPathForShell = escapeshellarg(trim($videoPath));
      $thumbnailFilepathForShell = escapeshellarg(trim($thumbnailFilepath));
      // Generate video thumbnail using FFmpeg
      $ffmpegCommand = "ffmpeg -i $videoPathForShell -ss 00:00:00 -vframes 1 $thumbnailFilepathForShell";
      exec($ffmpegCommand);

      // go on with generated video thumbnail as source
      $filepath = $thumbnailFilepath;
    }

    $imagick = new \Imagick($filepath);

    $orientation = $imagick->getImageOrientation();

    // TODO: does this really work?
    switch($orientation) {
      case \Imagick::ORIENTATION_BOTTOMRIGHT:
        $imagick->rotateimage("#000", 180); // rotate 180 degrees
        break;

      case \Imagick::ORIENTATION_RIGHTTOP:
        $imagick->rotateimage("#000", 90); // rotate 90 degrees CW
        break;

      case \Imagick::ORIENTATION_LEFTBOTTOM:
        $imagick->rotateimage("#000", -90); // rotate 90 degrees CCW
        break;
    }

    $imagick->setImageOrientation(\Imagick::ORIENTATION_TOPLEFT);

    $x = $width ?? option('thumbnail_width');
    $y = $height ?? option('thumbnail_height');
    $imagick->thumbnailImage($x, $y, true);
    $imagick->writeImage($thumbnailFilepath);

    header("Content-Type: " . $imagick->getImageMimeType());
    echo $imagick->getImageBlob();
  }

  createThumbnailImage($file, $width, $height, true);

};

