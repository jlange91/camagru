<style><?php include("{$path}/pages/post/index.css"); ?></style>
<?php
  if (is_connect() == 0)
    echo '<script>document.location.href="/signup";</script>';
?>
<div id='container'>
  <img src="/assets/filters/filter1.png" style="z-index:101;" class="superposition"></img>
  <div id="post-wrapper-button">
    <button class="snapshot-button">Snapshot</button>
  </div>
</div>
<div>

</div>

<script type="text/javascript">

<?php include("{$path}/pages/post/webcam.js"); ?>

  function getImageDimensions(file) {
    return new Promise (function (resolved, rejected) {
      var i = new Image()
      i.onload = function(){
        resolved({w: i.width, h: i.height})
      };
      i.src = file
    })
  }

  const container = document.querySelector('#container');
  var Webcam = new WebcamCamagru(),
      imageDataURL = "",
      imageWidth,
      imageHeight;


  Webcam.openCamera();
  Webcam.closeCamera();
  document.querySelector('.snapshot-button').onclick = async function() {
    imageDataURL = Webcam.takeSnapshot();

    if (imageDataURL) {
      Webcam.closeCamera();
      let image = document.createElement("img");
      image.setAttribute('class', "cam-img superposition");
      image.setAttribute('src', imageDataURL);
      container.prepend(image);
    }
    var dimensions = await getImageDimensions(imageDataURL);
    imageWidth = dimensions.w;
    imageHeight = dimensions.h;
  };


</script>
