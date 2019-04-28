function WebcamCamagru() {
  this.openCamera = function() {
    this._removeImg();
    const constraints = { video: true },
          video = document.createElement("video"),
          container = document.querySelector('#post-container');

    video.setAttribute('autoplay', "true");
    video.setAttribute('id', "post-cam");
    video.setAttribute('class', "post-superposition");
    navigator.mediaDevices.getUserMedia(constraints).
      then(function(stream) {
        video.srcObject = stream;
        container.prepend(video);
        document.querySelector('#post-wrapper-button').style.display = "inline";
        document.querySelector('.post-snapshot-button').disabled = false;
      }).catch(function (err) {
        video.remove();
        console.log('Something went wrong.');
        console.log(err);
      });
  }

  this.closeCamera = function() {
    const video = document.querySelector('#post-cam');

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

  this._removeImg = function() {
    let remove = document.querySelector('.post-cam-img');

    if (remove)
     remove.remove();
  }

  this._getImageDimensions = function(file) {
    return new Promise (function (resolved, rejected) {
      var i = new Image();
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
      image.setAttribute('class', "post-cam-img post-superposition");
      image.setAttribute('src', this.imageDataURL);
      container.prepend(image);
    }
    var dimensions = await this._getImageDimensions(this.imageDataURL);
    this.imageWidth = dimensions.w;
    this.imageHeight = dimensions.h;
  }

  this.takeSnapshot = function(){
    const video = document.querySelector('#post-cam');

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
