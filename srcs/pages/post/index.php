<style><?php include("{$path}/pages/post/index.css"); ?></style>
<?php
  if (is_connect() == 0) {
    echo '<script>document.location.href="/signup";</script>';
    die("");
  }
?>
<div id='post-container'>
  <div id="post-wrapper-arrow-buttons">
    <button id="post-back-button" class="button"><i class="material-icons">keyboard_arrow_left</i></button>
    <button id="post-next-button" class="button"><i class="material-icons">keyboard_arrow_right</i></button>
  </div>
  <img id="post-filter-image" class="post-superposition" onerror="this.style.display='none';" onload="this.style.display='inline';"></img>
  <img id="post-image" class="post-superposition" onerror="this.style.display='none';"></img>
  <img class="post-superposition" src="/assets/post.png"></img>
  <div id="post-wrapper-button">
    <button class="post-snapshot-button button" disabled><i class="material-icons">photo_camera</i></button>
    <button class="post-import-button button"><i class="material-icons">add</i></button>
    <input id="img-upload" type="file"/>
  </div>
</div>
<?php include("{$path}/pages/post/filters/carousel.php"); ?>
<?php include("{$path}/pages/post/commentary/index.php"); ?>
<script type="text/javascript">
  var step = 0;

  <?php include("{$path}/pages/post/webcam.js"); ?>
  <?php include("{$path}/pages/post/import.js"); ?>

  function displayByStep() {
    const img = document.querySelector('#post-image'),
          wrapperButton = document.querySelector('#post-wrapper-button'),
          arrowButtons = document.querySelector('#post-wrapper-arrow-buttons'),
          commentary = document.querySelector('#post-commentary'),
          rightArrow = document.querySelector('#post-next-button'),
          commentaryText = document.querySelector('#post-commentary-text');

    switch (step) {
      case 1:
        Carousel.display(true);
        wrapperButton.style.display = "none";
        arrowButtons.style.display = "inline";
        img.style.display = "inline";
        commentary.style.display = "none";
        rightArrow.style.display = "inline";
        commentaryText.value = "";
        break ;
      case 2:
        Carousel.display(false);
        commentary.style.display = "block";
        rightArrow.style.display = "none";
        break ;
      default:
        Webcam.openCamera();
        Carousel.display(true);
        wrapperButton.style.display = "inline";
        arrowButtons.style.display = "none";
        img.style.display = "none";
    }
  }

  Webcam.openCamera();
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

            var dragItem = document.querySelector("#post-filter-image");

            var active = false;
            var currentX;
            var currentY;
            var initialX;
            var initialY;
            var xOffset = 0;
            var yOffset = 0;

            dragItem.addEventListener("touchstart", dragStart, false);
            dragItem.addEventListener("touchend", dragEnd, false);
            dragItem.addEventListener("touchmove", drag, false);

            dragItem.addEventListener("mousedown", dragStart, false);
            dragItem.addEventListener("mouseup", dragEnd, false);
            dragItem.addEventListener("mousemove", drag, false);

            function dragStart(e) {
              if (e.type === "touchstart") {
                initialX = e.touches[0].clientX - xOffset;
                initialY = e.touches[0].clientY - yOffset;
              } else {
                initialX = e.clientX - xOffset;
                initialY = e.clientY - yOffset;
              }

              if (e.target === dragItem) {
                active = true;
              }
            }

            function dragEnd(e) {
              initialX = currentX;
              initialY = currentY;

              active = false;
            }

            function drag(e) {
              if (active) {

              e.preventDefault();

              if (e.type === "touchmove") {
              currentX = e.touches[0].clientX - initialX;
              currentY = e.touches[0].clientY - initialY;
              } else {
              currentX = e.clientX - initialX;
              currentY = e.clientY - initialY;
              }

              xOffset = currentX;
              yOffset = currentY;

              setTranslate(currentX, currentY, dragItem);
              }
            }

            function setTranslate(xPos, yPos, el) {
              el.style.transform = "translate3d(" + xPos + "px, " + yPos + "px, 0)";
            }

</script>
