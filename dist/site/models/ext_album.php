<?php

class ExtAlbumPage extends Page {

  public function getAlbumPath($absolute = false) {

    $albumPath = $this->album_path()->replacePathVars();

    if ($absolute) {
      $albumPath = $_SERVER['DOCUMENT_ROOT'] . $albumPath;
    }

    return $albumPath;

  }


  public function getAlbumFiles($sort = false) {

    if ($this->album_path()->isNotEmpty()) {

      $albumPath = $this->getAlbumPath();
      $absAlbumPath = $this->getAlbumPath(true);
      $files = [];

      // check if directory exists
      if (file_exists($absAlbumPath)) {

        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $videoExtensions = ['mp4', 'webm', 'mov', 'mpeg', 'mpeg2', 'avi'];
        $allowedExtensions = array_merge($imageExtensions, $videoExtensions);

        // get all files in the directory
        $files = array_reduce(
          scandir($absAlbumPath),
          function ($carry, $file) use ($absAlbumPath, $albumPath, $allowedExtensions, $imageExtensions) {
            $filePath = "$absAlbumPath/$file";
            // detect file extension
            $fileExt = pathinfo($filePath, PATHINFO_EXTENSION);
            $fileExt = strtolower($fileExt);
            if (in_array($fileExt, $allowedExtensions)) {
              $carry[] = [
                'name' => $file,
                'type' => in_array($fileExt, $imageExtensions) ? 'image' : 'video',
                'url' => $albumPath . '/' . $file,
                'path' => $filePath,
                'ext' => $fileExt,
              ];
            }
            return $carry;
          },
          []
        );

        if ($sort) {
          // sort files by modify date
          usort($files, function ($a, $b) {
            return filemtime($a['path']) - filemtime($b['path']);
          });
        }

      }

      return $files;

    }

    return [];

  }

}
