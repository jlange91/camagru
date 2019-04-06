class WebcamCamagru {
  openCamera() {
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
      }).catch(function () {
        video.remove();
        console.log('Something went wrong.');
        console.log(err);
      });
  }

  closeCamera() {
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

  takeSnapshot(){
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
      let imageDataURL = hidden_canvas.toDataURL('image/png');
      hidden_canvas.remove();
      document.querySelector('#post-wrapper-button').remove();
      return (imageDataURL);
    }
    else
      console.log("Don't find video container.")
  }
}
