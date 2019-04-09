<style><?php include("{$path}/pages/post/index.css"); ?></style>
<?php
  if (is_connect() == 0) {
    echo '<script>document.location.href="/signup";</script>';
    die("");
  }
?>
<div id='container'>
  <img src="/assets/filters/filter1.png" style="z-index:101;" class="superposition"></img>
  <div id="post-wrapper-button">
    <img class="superposition" src="/assets/post.png"></img>
    <button class="snapshot-button button" disabled><i class="material-icons">photo_camera</i></button>
    <button class="import-button button"><i class="material-icons">add</i></button>
  </div>
</div>

<script type="text/javascript">

<?php include("{$path}/pages/post/webcam.js"); ?>



  const container = document.querySelector('#container');
  var Webcam = new WebcamCamagru(),
      imageDataURL = "",
      imageWidth,
      imageHeight;


  Webcam.openCamera();
  Webcam.closeCamera();
  document.querySelector('.snapshot-button').onclick = function () {Webcam.takeSnapshot();}


</script>
<?php include("{$path}/pages/post/filters/index.php"); ?>
