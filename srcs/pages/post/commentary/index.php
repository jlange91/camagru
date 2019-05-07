<style><?php include("{$path}/pages/post/commentary/index.css"); ?></style>
<div id="post-commentary">
  <textarea id="post-commentary-text" class="textarea" placeholder="e.g. Hello world"></textarea>
  <input id="post-commentary-button" class="button is-primary" type="submit" value="Send" />
</div>
<script>
  const text = document.querySelector("#post-commentary-text");
  const sendButton = document.querySelector("#post-commentary-button");
  var commentary = "";

  text.oninput = function () {
    commentary = this.value;
  }
  sendButton.onclick = function() {
    const filterId = Carousel.currId,
          imgBase64 = document.querySelector("#post-image").src;
    console.log("image: " + imgBase64, "commentary: " + commentary + "\nfilter: " + filterId);
  }
</script>
