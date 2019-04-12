<style>

.carousel {
  margin: 20 auto;
    width: 320px;
    height: 240px;
  position: relative;
  perspective: 2000px;
}

.context3d {
  height: 100%;
  width: 100%;
  position: absolute;
  transform-style: preserve-3d;
  transition: transform 1s;
}
.context3d div {
  transform-style: preserve-3d;
}

.item {
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

.next, .prev {
  color: #444;
  padding: 1em 2em;
  cursor: pointer;
  background: #CCC;
  border-radius: 5px;
  border-top: 1px solid #FFF;
  box-shadow: 0 5px 0 #999;
  transition: box-shadow 0.1s, top 0.1s;
}
.next:hover, .prev:hover { color: #000; }
.next:active, .prev:active {
  top: 104px;
  box-shadow: 0 1px 0 #999;
}
.next { right: 5em; }
.prev { left: 5em; }

@media only screen and (max-width: 680px)
{
  .carousel {
    width: 180px;
    height: 135px;
  }
  .item {
    width: 180px;
    height: 135px;
  }
}

.carousel-wrapper {
  overflow: hidden;
}


</style>
<div class="carousel-wrapper">
  <div class="carousel">
    <div class="context3d">
      <div class="item-wrapper">
        <div class="item"><img src="/assets/filters/filter0.png"></img></div>
      </div>
      <div class="item-wrapper">
        <div class="item"><img src="/assets/filters/filter1.png"></img></div>
      </div>
      <div class="item-wrapper">
        <div class="item"><img src="/assets/filters/filter2.png"></div>
      </div>
      <div class="item-wrapper">
        <div class="item"><img src="/assets/filters/filter3.png"></div>
      </div>
    </div>
  </div>
</div>
<div class="next">Next</div>
<div class="prev">Prev</div>
<script>

  const context3d = document.querySelector('.context3d'),
        items = document.querySelectorAll('.item'),
        filter = document.querySelectorAll('.filter'),
        nbItems = items.length,
        gapDeg = 360 / nbItems;
  var currDeg = 0;
  var currId = 0;

  function placeFilter() {
    filter[0].setAttribute("src", "/assets/filters/filter" + currId + ".png");
  }

  function placeItems() {
    var gap = 0;

    document.querySelectorAll('.item-wrapper').forEach(function(element) {
      element.style.cssText =
      "transform: rotateY(" + gap + "deg) translateZ(250px)  rotateY(-" + gap + "deg);"
      gap = gap + gapDeg;
    });
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
    console.log(currId);
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
  }

  document.querySelector('.next').onclick = function() {rotate("n");};
  document.querySelector('.prev').onclick = function() {rotate("p");};
  placeItems();
  placeFilter();

</script>
