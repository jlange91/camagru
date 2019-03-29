<?php
  if (is_connect() == 0)
    echo '<script>document.location.href="/signup";</script>';
?>
<style>
#container {
	margin: 0px auto;
	width: 500px;
	height: 375px;
	border: 10px #00d1b2 solid;
}
#videoElement {
	width: 500px;
	height: 375px;
	background-color: #008071;
}

.blur{filter: blur(5px);}
.brightness{filter: brightness(0.4);}
.contrast{filter: contrast(200%);}
.grayscale{filter: grayscale(50%);}
.hue-rotate{filter: hue-rotate(90deg);}
.invert{filter: invert(75%);}
.saturate{filter: saturate(30%);}
.sepia{filter: sepia(60%);}
</style>
<div id='container'>
<video autoplay id='videoElement'></video>
<p><button class="capture-button">Capture video</button>
<p><button id="cssfilters-apply">Apply CSS filter</button></p>
</div>
<script>
const captureVideoButton =
  document.querySelector('.capture-button');
const cssFiltersButton =
  document.querySelector('#cssfilters-apply');
const video =
  document.querySelector('video');

let filterIndex = 0;
const filters = [
  'grayscale',
  'sepia',
  'blur',
  'brightness',
  'contrast',
  'hue-rotate',
  'saturate',
  'invert',
  ''
];

captureVideoButton.onclick = function() {
  const constraints = {
    video: true
  };
  navigator.mediaDevices.getUserMedia(constraints).
    then(handleSuccess).catch(handleError);
};

cssFiltersButton.onclick = video.onclick = function() {
  video.className = filters[filterIndex++ % filters.length];
};

function handleSuccess(stream) {
  video.srcObject = stream;
}

function handleError(stream) {
  console.log('Something went wrong.');
}

</script>
