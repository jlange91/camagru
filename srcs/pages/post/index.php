<style><?php include("{$path}/pages/post/index.css"); ?></style>
<?php
  if (is_connect() == 0) {
    echo '<script>document.location.href="/signup";</script>';
    die("");
  }
?>
<div id='post-container'>
  <img class="post-superposition post-filter-image" onerror="this.style.display='none';" onload="this.style.display='inline';"></img>
  <div id="post-wrapper-button">
    <img class="post-superposition" src="/assets/post.png"></img>
    <button class="post-snapshot-button button" disabled><i class="material-icons">photo_camera</i></button>
    <button class="post-import-button button"><i class="material-icons">add</i></button>
  </div>
</div>
<?php include("{$path}/pages/post/filters/carousel.php"); ?>
<script type="text/javascript">

<?php include("{$path}/pages/post/webcam.js"); ?>

  const container = document.querySelector('#post-container');
  var Webcam = new WebcamCamagru();

  Webcam.openCamera();
  document.querySelector('.post-snapshot-button').onclick = function () {Webcam.takeSnapshot();}

</script>
