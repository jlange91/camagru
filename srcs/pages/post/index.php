<?php
  if (is_connect() == 0)
    echo '<script>document.location.href="/signup";</script>';
?>
<style>
#container {
	margin: 0px auto;
	width: 80%;
  max-width: 580px;
}
#videoElement {
	width: 100%;
}

</style>
<div id='container'>
  <video autoplay id='videoElement'></video>
  <button class="capture-button">Take a picture</button>
  <canvas style="display:none;"></canvas>
  <img class="photo"></img>
</div>
<script>
  class WebcamCamagru {
    constructor() {
    }

    open() {
      const constraints = {
        video: true
      };
      navigator.mediaDevices.getUserMedia(constraints).
        then(this.handleSuccess).catch(this.handleError);
    }

    closeCamera() {
      if (this.stream)
        this.stream.stop();
    }

    handleSuccess(stream) {
      document.querySelector('video').srcObject = stream;
    }

    handleError(stream) {
      console.log('Something went wrong.');
    }

    takeSnapshot(){

      var hidden_canvas = document.querySelector('canvas'),
      video = document.querySelector('video'),
      image = document.querySelector('img.photo'),

      // Get the exact size of the video element.
      width = video.videoWidth,
      height = video.videoHeight,

      // Context object for working with the canvas.
      context = hidden_canvas.getContext('2d');

      // Set the canvas to the same dimensions as the video.
      hidden_canvas.width = width;
      hidden_canvas.height = height;

      // Draw a copy of the current frame from the video on the canvas.
      context.drawImage(video, 0, 0, width, height);

      // Get an image dataURL from the canvas.
      var imageDataURL = hidden_canvas.toDataURL('image/png');

      // Set the dataURL as source of an image element, showing the captured photo.
      image.setAttribute('src', imageDataURL);
      document.querySelector('video').style.display = "none;"

    }
  }

  var Webcam = new WebcamCamagru();

  Webcam.open();
document.querySelector('.capture-button').onclick = Webcam.closeCamera;


</script>
