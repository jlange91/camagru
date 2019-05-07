var importButton = document.querySelector('.post-import-button');
var inputImage = document.querySelector('#img-upload');

importButton.onclick = function () {
  document.querySelector('#img-upload').click();
}

function checkFileExtension(type) {
  const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];

  return (validImageTypes.includes(type));
}

inputImage.onchange = function () {
  var preview = document.querySelector('#post-image'); //selects the query named img
  var file    = inputImage.files[0]; //sames as here
  if (!file)
    return ;
  var reader  = new FileReader();
  if (!checkFileExtension(file['type'])) {
    window.alert("Type file is not allowed. Use .jpg or .png image.");
    return ;
  }
  Webcam.closeCamera();

  reader.onloadend = function () {
      var image = new Image();

      image.onload = function() {
        let originalHeight = image.height,
            originalWidth = image.width,
            startX = 0,
            startY = 0,
            newHeight,
            newWidth,
            newImage;

        if (originalWidth > originalHeight) {
          newWidth = 640;
          newHeight = (newWidth * originalHeight) / originalWidth;
          startY = (480 - newHeight) / 2;
        }
        else {
          newHeight = 480;
          newWidth = (newHeight * originalWidth) / originalHeight;
          startX = (640 - newWidth) / 2;
        }
        const hidden_canvas = document.createElement("canvas"),
              ctx = hidden_canvas.getContext("2d");

        hidden_canvas.width = 640;
        hidden_canvas.height = 480;
        ctx.beginPath();
        ctx.rect(0, 0, 640, 480);
        ctx.fillStyle = "black";
        ctx.fill();
        ctx.drawImage(image, startX, startY, newWidth, newHeight);
        newImage = hidden_canvas.toDataURL('image/png');
        preview.src = newImage;
        hidden_canvas.remove();
      };
      image.src = reader.result;
  }

  if (file) {
      reader.readAsDataURL(file); //reads the data as a URL
  } else {
      preview.src = "";
  }
}
