const text = document.querySelector("#post-commentary-text"),
      sendButton = document.querySelector("#post-commentary-button"),
      publicationId = $_GET("publicationId");

sendButton.onclick = function() {
  const xhr = getXMLHttpRequest();

  xhr.open("GET", '/ajax/comment?' + "publicationId=" + publicationId + "&comment=" + text.value, true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function() { // Call a function when the state changes.
    loadingCard(publicationId);
    sendButton.disabled = false;
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
    }
    else {
      window.alert(this.responseText);
    }
  }
  sendButton.disabled = true;
  xhr.send();
  text.value = "";
}
