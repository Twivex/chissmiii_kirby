    </main>

    <footer class="position-sticky top-100">
      <?php snippet('globals/footer-nav'); ?>
    </footer>

    <?php snippet('globals/bg-img') ?>
    <?php snippet('globals/cookie-banner') ?>

    <script>
      const LANGUAGE_CODE = '<?= $kirby->language()->code() ?>';
    </script>
    <script src="/resources/js/app.js"></script>
  </body>
</html>