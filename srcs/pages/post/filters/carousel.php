<style><?php include("{$path}/pages/post/filters/carousel.css"); ?></style>
<div class="post-carousel-wrapper">
  <div class="post-carousel">
    <div class="post-context3d">
      <?php
        $fi = new FilesystemIterator($path . "/assets/filters", FilesystemIterator::SKIP_DOTS);
        $nbFilters = iterator_count($fi);

        for ($i = 0; $i < $nbFilters; $i++) {
          echo '
            <div class="post-item-wrapper">
              <div class="post-item"><img src="/assets/filters/filter' . $i . '.png"></img></div>
            </div>
          ';
        }
      ?>
    </div>
  </div>
</div>
<script><?php include("{$path}/pages/post/filters/carousel.js"); ?></script>
