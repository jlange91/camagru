function CarouselCamagru() {
  const context3d = document.querySelector('.post-context3d'),
        items = document.querySelectorAll('.post-item'),
        filter = document.querySelector('#post-filter-image'),
        filterWrapper = document.querySelectorAll('#post-image-wrapper'),
        nbItems = items.length,
        gapDeg = 360 / nbItems;
  var currDeg = 0;
  this.currId = 0;

  this.placeFilter = function() {
    if (this.currId == 0) {
      filter.style.display = "none";
    }
    else {
      filter.style.display = "inline";
      const img = new Image();

      img.onload = function(){
        filter.style.height = img.height * ratio;
        filter.style.width = img.width * ratio;
        filter.src = img.src;
      }

      img.src = "/assets/filters/filter" + this.currId + ".png";
    }
  }

  this.placeItems = function() {
    var gap = 0;

    document.querySelectorAll('.post-item-wrapper').forEach(function(element) {
      element.style.cssText =
      "transform: rotateY(" + gap + "deg) translateZ(250px)  rotateY(-" + gap + "deg);"
      gap = gap + gapDeg;
    });
  }

  this.rotate =  function() {
    const x = window.event.clientX;
    const y = window.event.clientY;

    if (x > window.innerWidth / 2){
      currDeg = currDeg - gapDeg;
      this.currId = (this.currId + 1 >= nbItems) ? 0 : this.currId + 1;
    }
    else {
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
      this.placeFilter();
  }

  this.display = function (bool) {
    switch (bool) {
      case true:
        document.querySelector('.post-carousel-wrapper').style.display = "inline";
        break;
      case false:
        document.querySelector('.post-carousel-wrapper').style.display = "none";
        break;
      default:
        document.querySelector('.post-carousel-wrapper').style.display = "inline";

    }
  }
  this.placeItems();
  this.placeFilter();
}

var Carousel = new CarouselCamagru();
document.querySelector('.post-carousel-wrapper').onclick = function () {Carousel.rotate();}
var filterImage = document.querySelector('#post-filter-image');
