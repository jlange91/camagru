function WebcamCamagru() {
  this.openCamera = function() {
    const constraints = { video: true },
          video = document.createElement("video"),
          container = document.querySelector('#container');

    video.setAttribute('autoplay', "true");
    video.setAttribute('id', "cam");
    video.setAttribute('class', "superposition");
    navigator.mediaDevices.getUserMedia(constraints).
      then(function(stream) {
        video.srcObject = stream;
        container.prepend(video);
        document.querySelector('#post-wrapper-button').style.display = "inline";
        document.querySelector('.snapshot-button').disabled = false;
      }).catch(function () {
        video.remove();
        console.log('Something went wrong.');
        console.log(err);
      });
  }

  this.closeCamera = function() {
    const video = document.querySelector('video');

    if (video) {
      const stream = video.srcObject;
      if (stream) {
        const tracks = stream.getTracks();
        tracks.forEach(function(track) {
          track.stop();
        });
        video.remove();
      }
    }
  }

  this._getImageDimensions = function(file) {
    return new Promise (function (resolved, rejected) {
      var i = new Image()
      i.onload = function(){
        resolved({w: i.width, h: i.height})
      };
      i.src = file
    })
  }

  this._createImg = async function() {
    if (this.imageDataURL) {
      this.closeCamera();
      let image = document.createElement("img");
      image.setAttribute('class', "cam-img superposition");
      image.setAttribute('src', this.imageDataURL);
      container.prepend(image);
    }
    var dimensions = await this._getImageDimensions(this.imageDataURL);
    this.imageWidth = dimensions.w;
    this.imageHeight = dimensions.h;
  }

  this.takeSnapshot = function(){
    const video = document.querySelector('video');

    if (video) {
      const hidden_canvas = document.createElement("canvas"),

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

      // Get an image dataURL from the canvas and remove canvas
      this.imageDataURL = hidden_canvas.toDataURL('image/png');
      hidden_canvas.remove();
      document.querySelector('#post-wrapper-button').style.display = "none";
      this._createImg();
    }
    else
      console.log("Don't find video container.")
  }
}
