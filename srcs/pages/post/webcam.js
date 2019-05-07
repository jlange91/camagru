function WebcamCamagru() {
  this.openCamera = function() {
    const constraints = { video: { facingMode: "user" } },
          video = document.createElement("video"),
          container = document.querySelector('#post-container');

    video.setAttribute('autoplay', "true");
    video.setAttribute('id', "post-cam");
    video.setAttribute('class', "post-superposition");
    if (navigator.mediaDevices.getUserMedia === undefined) {
      navigator.mediaDevices.getUserMedia = function(constraints) {
        var getUserMedia = navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
        if (!getUserMedia) {
          return Promise.reject(new Error('getUserMedia is not implemented in this browser'));
        }
        return new Promise(function(resolve, reject) {
          getUserMedia.call(navigator, constraints, resolve, reject);
        });
      }
    }
    navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
        if ("srcObject" in video) {
          video.srcObject = stream;
        } else {
          video.src = window.URL.createObjectURL(stream);
        }
        video.onloadedmetadata = function(e) {
          video.play();
        };
        container.prepend(video);
        document.querySelector('.post-snapshot-button').disabled = false;
      }).catch(function (err) {
        video.remove();
        console.log('Something went wrong with camera.');
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
    document.querySelector('.post-snapshot-button').disabled = true;
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
    let image = document.querySelector("#post-image");

    if (this.imageDataURL) {
      this.closeCamera();
      image.setAttribute('src', this.imageDataURL);
    }
    var dimensions = await this._getImageDimensions(this.imageDataURL);
    this.imageWidth = dimensions.w;
    this.imageHeight = dimensions.h;
  }

  this.takeSnapshot = function(){
    const video = document.querySelector('#post-cam');

    if (video) {
      const hidden_canvas = document.createElement("canvas"),

      width = video.videoWidth,
      height = video.videoHeight,
      context = hidden_canvas.getContext('2d');
      hidden_canvas.width = width;
      hidden_canvas.height = height;
      context.drawImage(video, 0, 0, width, height);
      this.imageDataURL = hidden_canvas.toDataURL('image/png');
      hidden_canvas.remove();
      this._createImg();
    }
    else
      console.log("Don't find video container.")
  }
}

var Webcam = new WebcamCamagru();
