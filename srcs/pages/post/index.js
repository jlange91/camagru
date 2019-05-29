  var step = 0;

  function displayByStep() {
    const img = document.querySelector('#post-image'),
          wrapperButton = document.querySelector('#post-wrapper-button'),
          arrowButtons = document.querySelector('#post-wrapper-arrow-buttons'),
          commentary = document.querySelector('#commentary'),
          rightArrow = document.querySelector('#post-next-button'),
          commentaryText = document.querySelector('#commentary-text');

    switch (step) {
      case 1:
        Carousel.display(true);
        wrapperButton.style.display = "none";
        arrowButtons.style.display = "inline";
        img.style.display = "inline";
        commentary.style.display = "none";
        rightArrow.style.display = "inline";
        break ;
      case 2:
        Carousel.display(false);
        commentary.style.display = "block";
        rightArrow.style.display = "none";
        break ;
      default:
        commentary.style.display = "none";
        Webcam.openCamera();
        Carousel.display(true);
        wrapperButton.style.display = "inline";
        arrowButtons.style.display = "none";
        img.style.display = "none";
    }
  }

  displayByStep();
  document.querySelector('.post-snapshot-button').onclick = function () {
    Webcam.takeSnapshot();
  }
  const img = document.querySelector('#post-image');
  const backButton = document.querySelector('#post-back-button');
  const nextButton = document.querySelector('#post-next-button');

  img.onload = function () {
    step = 1;
    displayByStep();
  }
  backButton.onclick = function() {
    step = step - 1;
    displayByStep();
  }
  nextButton.onclick = function() {
    step = step + 1;
    displayByStep();
  }
