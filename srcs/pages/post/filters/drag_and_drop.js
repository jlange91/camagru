var dragItem = document.querySelector("#post-filter-image"),
    active = false,
    currentX,
    currentY,
    initialX,
    initialY,
    xOffset = 0,
    yOffset = 0,
    ratio = 1;

function resizeRatio(width) {
  ratio = document.querySelector('#post-container').clientWidth / 640;
  setTranslate(currentX, currentY, dragItem);
  const img = new Image();
  const filter = document.querySelector("#post-filter-image");

  img.onload = function(){
    filter.style.height = img.height * ratio;
    filter.style.width = img.width * ratio;
    filter.src = img.src;
  }

  if (Carousel.currId != 0)
    img.src = "/assets/filters/filter" + Carousel.currId + ".png";
}

function dragStart(e) {
  if (e.type === "touchstart") {
    initialX = e.touches[0].clientX / ratio - xOffset;
    initialY = e.touches[0].clientY / ratio - yOffset;
  } else {
    initialX = e.clientX / ratio - xOffset;
    initialY = e.clientY / ratio - yOffset;
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
  currentX = e.touches[0].clientX / ratio - initialX;
  currentY = e.touches[0].clientY / ratio - initialY;
  } else {
  currentX = e.clientX / ratio - initialX;
  currentY = e.clientY / ratio - initialY;
  }

  xOffset = currentX;
  yOffset = currentY;

  setTranslate(currentX, currentY, dragItem);
  }
}

function setTranslate(xPos, yPos, el) {
  el.style.transform = "translate3d(" + (xPos * ratio) + "px, " + (yPos * ratio) + "px, 0)";
}

window.onresize = function() {
  resizeRatio(window.innerWidth);
};
window.onload = function() {
  resizeRatio(window.innerWidth);
}

dragItem.addEventListener("touchstart", dragStart, false);
dragItem.addEventListener("touchend", dragEnd, false);
dragItem.addEventListener("touchmove", drag, false);

dragItem.addEventListener("mousedown", dragStart, false);
dragItem.addEventListener("mouseup", dragEnd, false);
dragItem.addEventListener("mousemove", drag, false);
