<?php
use Kirby\Http\Header;
use Kirby\Http\Response;

return function ($file, $width = null, $height = null) {

  header("Cache-Control: max-age=2592000, public");

  function isVideoFile($filepath) {
    return
      in_array(
        strtolower(pathinfo($filepath, PATHINFO_EXTENSION)),
        ['mp4', 'mov', 'webm', 'mpeg']
      );
  }

  function createThumbnailImage($file, $width = null, $height = null, $returnFile = false) {
    $filepath = ltrim($file, '/');

    // default thumbnail path for images
    $thumbnailFilepath = $filepath;

    // update thumbnail path for videos
    if (isVideoFile($filepath)) {
      $filename = pathinfo($filepath, PATHINFO_FILENAME);
      $pathToFile = dirname($filepath);
      $thumbnailFilepath = $pathToFile . '/' . $filename . '.jpg';
    }

    // add thumbnail path prefix
    $thumbnailFilepath = $_SERVER['DOCUMENT_ROOT'] . option('thumbnail_path') . '/' . $thumbnailFilepath;

    // add thumbnail dimensions suffix, if given
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
      // create original thumbnail (without dimensions) and go on with
      // the original thumbnail as source to keep required resources low
      if (!file_exists($thumbnailOriginalFilepath)) {
        createThumbnailImage($file);
      }
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

      // go on with generated video thumbnail as source -> size down
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

    // return image as blob
    header("Content-Type: " . $imagick->getImageMimeType());
    echo $imagick->getImageBlob();
  }

  createThumbnailImage($file, $width, $height, true);

};

