const text = document.querySelector("#post-commentary-text");
const sendButton = document.querySelector("#post-commentary-button");

sendButton.onclick = function() {
  const filterId = Carousel.currId,
        imgBase64 = document.querySelector("#post-image").src;
        xhr = getXMLHttpRequest();

  xhr.open("POST", '/ajax/post', true);
  xhr.setRequestHeader("Content-Type", "application/json");
  xhr.onload = function() { // Call a function when the state changes.
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      window.alert("Successfull upload.");
      window.setTimeout(function() {
        location.href = "/";
      }, 1000);
    }
    else {
      window.alert(this.responseText);
      sendButton.disabled = false;
    }
  }
  sendButton.disabled = true;
  xhr.send(JSON.stringify({
    imgBase64: imgBase64,
    commentary: text.value,
    filterId: filterId,
    xOffset: xOffset,
    yOffset: yOffset
  }));
}
