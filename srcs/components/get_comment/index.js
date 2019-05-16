function loadingComment(commentId) {
  const xhr = getXMLHttpRequest();

  xhr.open("GET", "/ajax/check_comment?commentId=" + commentId, true);
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
  xhr.onload = function() { // Call a function when the state changes.
    let deleteButton = document.querySelector("#comment-delete-button-" + commentId);

    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      if (this.response == "1")
        deleteButton.innerHTML = '<button class="delete button is-primary" onclick="deleteComment(\'' + commentId + '\')"></button>';
      else
        deleteButton.innerHTML = '';
    }
  }
  xhr.send();
}

function deleteComment(commentId) {
  if (window.confirm("Do you really want to delete this comment?")) {
    const xhr = getXMLHttpRequest();

    xhr.open("GET", "/ajax/delete_comment?commentId=" + commentId, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onload = function() { // Call a function when the state changes.
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        loadComments();
        loadingCard(publicationId);
        moreButtonUpdate();
      }
      else {
        window.alert("Error.");
      }
    }
    xhr.send();
  }
}

var getComment = (username, comment, date, commentId) => {
  let ret;

  ret = '\
  <article id="comment-' + sanitizeHTML(commentId) + '" class="media comment">\
    <div class="media-content">\
      <div class="content">\
        <p>\
          <strong>@' + sanitizeHTML(username) + '</strong>\
          <br>\
          ' + sanitizeHTML(comment) +'\
        </p>\
        <time>' + sanitizeHTML(date) + '</time>\
      </div>\
    </div>\
    <div id="comment-delete-button-' + sanitizeHTML(commentId) + '" class="media-right">\
    </div>\
  </article>'
  return (ret);
}
