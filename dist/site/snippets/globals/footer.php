    </main>

    <footer class="position-sticky top-100">
      <?php snippet('globals/footer-nav'); ?>
    </footer>

    <?php
      $pageBgImages = $page->bg_img();
      $siteBgImages = $site->files()->filterBy('tags', 'background');
      if ($page->settings_enabled()->toBool()) {
        $source = $pageM;
      } elseif ($page->parents()->count() > 0 && $page->parent()->settings_enabled()->toBool()) {
        $source = $page->parent();
      } else {
        $source = $site;
      }
      $bgImage = $source->bg_img()->toFile();

      if ($bgImage !== null) {
        snippet('globals/bg-img', [ 'img' => $bgImage ]);
      }
    ?>

    <?php snippet('globals/cookie-banner') ?>

    <script>
      const LANGUAGE_CODE = '<?= $kirby->language()->code() ?>';
    </script>
    <?php
      // retrieve all js files from js resource path
      $jsBasepath = option('resource_paths')['js'];
      $jsFiles = scandir($jsBasepath);
      $jsFiles = array_filter($jsFiles, function($file) {
        return strpos($file, '.js') === strlen($file) - 3;
      });
      // create script tags for each js file
      $jsResources = array_map(function ($jsFile) use ($jsBasepath) {
        return js($jsBasepath . $jsFile);
      }, $jsFiles);
      // print script tags
      echo implode("\n", $jsResources);
    ?>
  </body>
</html>