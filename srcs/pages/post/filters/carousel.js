const context3d = document.querySelector('.post-context3d'),
      items = document.querySelectorAll('.post-item'),
      filter = document.querySelectorAll('.post-filter-image'),
      nbItems = items.length,
      gapDeg = 360 / nbItems;
var currDeg = 0;
this.currId = 0;

function placeFilter() {
  if (this.currId == 0) {
    filter[0].style.display = "none";
  }
  else {
    filter[0].style.display = "inline";
    filter[0].setAttribute("src", "/assets/filters/filter" + this.currId + ".png");
  }
}

function placeItems() {
  var gap = 0;

  document.querySelectorAll('.post-item-wrapper').forEach(function(element) {
    element.style.cssText =
    "transform: rotateY(" + gap + "deg) translateZ(250px)  rotateY(-" + gap + "deg);"
    gap = gap + gapDeg;
  });
}

function setOnClickFunction() {
  let idNext = (this.currId + 1 >= nbItems) ? 0 : this.currId + 1;
  let idPrevious = (this.currId - 1 < 0) ? nbItems - 1 : this.currId - 1;

  items[idNext].onclick = function() {rotate("n");};
  items[idPrevious].onclick = function() {rotate("p");};
}

function rotate(e){
  if(e =="n"){
    currDeg = currDeg - gapDeg;
    this.currId = (this.currId + 1 >= nbItems) ? 0 : this.currId + 1;
  }
  if(e =="p"){
    currDeg = currDeg + gapDeg;
    this.currId = (this.currId - 1 < 0) ? nbItems - 1 : this.currId - 1;
  }
  context3d.style.cssText =
    "-webkit-transform: rotateY("+currDeg+"deg);"+
    "-moz-transform: rotateY("+currDeg+"deg);"+
    "-o-transform: rotateY("+currDeg+"deg);"+
    "transform: rotateY("+currDeg+"deg);";
    items.forEach(function(element) {
      element.style.cssText =
      "-webkit-transform: rotateY("+(-currDeg)+"deg);" +
      "-moz-transform: rotateY("+(-currDeg)+"deg);" +
      "-o-transform: rotateY("+(-currDeg)+"deg);" +
      "transform: rotateY("+(-currDeg)+"deg);";
    });
    placeFilter();
    setOnClickFunction();
}

setOnClickFunction();
placeItems();
placeFilter();
