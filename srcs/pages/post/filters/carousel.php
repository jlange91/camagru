<style>

.post-carousel {
  margin: 20 auto;
  width: 320px;
  height: 240px;
  position: relative;
  perspective: 2000px;
}

.post-context3d {
  height: 100%;
  width: 100%;
  position: absolute;
  transform-style: preserve-3d;
  transition: transform 1s;
}

.post-context3d div {
  transform-style: preserve-3d;
}

.post-item {
  background: #ed1c24;
  display: block;
  position: absolute;
  background: #000;
  width: 320px;
  height: 240px;
  line-height: 200px;
  font-size: 2em;
  text-align: center;
  color: #FFF;
  opacity: 0.95;
  border-radius: 10px;
  transition: transform 1s;
}

@media only screen and (max-width: 680px)
{
  .post-carousel {
    width: 200px;
    height: 150px;
  }
  .post-item {
    width: 200px;
    height: 150px;
  }
}

.post-carousel-wrapper {
  overflow: hidden;
}

.post-button-next {
  right: 1px;
    position: absolute;
    top: 70%; /* poussé de la moitié de hauteur du référent */
    transform: translateY(-30%); /* tiré de la moitié de sa propre hauteur */
  }
.post-button-prev {
  left: 1px;
    position: absolute;
    top: 70%; /* poussé de la moitié de hauteur du référent */
  transform: translateY(-30%); /* tiré de la moitié de sa propre hauteur */}

</style>
<div class="post-carousel-wrapper">
  <div class="post-carousel">
    <div class="post-context3d">
      <div class="post-item-wrapper">
        <div class="post-item"><img src="/assets/filters/filter0.png"></img></div>
      </div>
      <div class="post-item-wrapper">
        <div class="post-item"><img src="/assets/filters/filter1.png"></img></div>
      </div>
      <div class="post-item-wrapper">
        <div class="post-item"><img src="/assets/filters/filter2.png"></div>
      </div>
      <div class="post-item-wrapper">
        <div class="post-item"><img src="/assets/filters/filter3.png"></div>
      </div>
    </div>
  </div>
</div>
<script>

  const context3d = document.querySelector('.post-context3d'),
        items = document.querySelectorAll('.post-item'),
        filter = document.querySelectorAll('.post-filter-image'),
        nbItems = items.length,
        gapDeg = 360 / nbItems;
  var currDeg = 0;
  var currId = 0;

  function placeFilter() {
    if (currId == 0) {
      filter[0].style.display = "none";
    }
    else {
      filter[0].style.display = "inline";
      filter[0].setAttribute("src", "/assets/filters/filter" + currId + ".png");
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
    let idNext = (currId + 1 >= nbItems) ? 0 : currId + 1;
    let idPrevious = (currId - 1 < 0) ? nbItems - 1 : currId - 1;

    items[idNext].onclick = function() {rotate("n");};
    items[idPrevious].onclick = function() {rotate("p");};
  }

  function rotate(e){
    if(e =="n"){
      currDeg = currDeg - gapDeg;
      currId = (currId + 1 >= nbItems) ? 0 : currId + 1;
    }
    if(e =="p"){
      currDeg = currDeg + gapDeg;
      currId = (currId - 1 < 0) ? nbItems - 1 : currId - 1;
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

</script>
