<?php
use Kirby\Http\Header;
use Kirby\Http\Response;

return function ($kirby, $file) {
  $filepath = ltrim($file, '/');
  $thumbnailFilepath = $_SERVER['DOCUMENT_ROOT'] . option('thumbnail_path') . '/' . $filepath;

  if (file_exists($thumbnailFilepath)) {
    echo Response::file($thumbnailFilepath);
    return;
  }

  $thumbnailDirpath = dirname($thumbnailFilepath);
  if (!is_dir($thumbnailDirpath)) {
    $thumbnailDirpathCreated = mkdir($thumbnailDirpath, 0775, true);
    if (!$thumbnailDirpathCreated) {
      Header::status(400);
      error_log("Directory $thumbnailDirpath could not be created.");
      exit;
    }
  }

  $imagick = new \Imagick($filepath);

  $orientation = $imagick->getImageOrientation();

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

  $width = option('thumbnail_width');
  $height = option('thumbnail_height');
  $imagick->thumbnailImage($width, $height, true);
  $imagick->writeImage($thumbnailFilepath);

  header("Content-Type: " . $imagick->getImageMimeType());
  echo $imagick->getImageBlob();

};

