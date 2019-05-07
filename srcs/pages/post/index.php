<style><?php include("{$path}/pages/post/index.css"); ?></style>
<?php
  if (is_connect() == 0) {
    echo '<script>document.location.href="/signup";</script>';
    die("");
  }
?>
<div id='post-container'>
  <div id="post-wrapper-arrow-buttons">
    <button id="post-back-button" class="button"><i class="material-icons">keyboard_arrow_left</i></button>
    <button id="post-next-button" class="button"><i class="material-icons">keyboard_arrow_right</i></button>
  </div>
  <div id="post-image-wrapper" class="post-superposition" >
    <img id="post-filter-image" class="post-superposition" onerror="this.style.display='none';" onload="this.style.display='inline';"></img>
  </div>
  <img id="post-image" class="post-superposition" onerror="this.style.display='none';"></img>
  <img class="post-superposition" src="/assets/post.png"></img>
  <div id="post-wrapper-button">
    <button class="post-snapshot-button button" disabled><i class="material-icons">photo_camera</i></button>
    <button class="post-import-button button"><i class="material-icons">add</i></button>
    <input id="img-upload" type="file"/>
  </div>
</div>
<?php include("{$path}/pages/post/filters/carousel.php"); ?>
<?php include("{$path}/pages/post/commentary/index.php"); ?>
<script type="text/javascript">
  <?php include("{$path}/pages/post/webcam.js"); ?>
  <?php include("{$path}/pages/post/import.js"); ?>
  <?php include("{$path}/pages/post/index.js"); ?>
  <?php include("{$path}/pages/post/filters/drag_and_drop.js"); ?>
</script>
