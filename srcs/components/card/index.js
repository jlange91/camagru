function loadingCard(publicationId) {
    var xhr = getXMLHttpRequest();

    xhr.open("GET", "/ajax/count_likes?publicationId=" + publicationId, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onload = function() { // Call a function when the state changes.
      let nbLikes = document.querySelector("#likes-nb-" + publicationId);

      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        nbLikes.innerHTML = this.response;
      }
    }
    xhr.send();
    xhr = getXMLHttpRequest();
    xhr.open("GET", "/ajax/count_comments?publicationId=" + publicationId, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onload = function() { // Call a function when the state changes.
      let nbComments = document.querySelector("#comments-nb-" + publicationId);

      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        nbComments.innerHTML = this.response;
      }
    }
    xhr.send();
    if (isConnect) {
      xhr = getXMLHttpRequest();
      xhr.open("GET", "/ajax/check_like?publicationId=" + publicationId, true);
      xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
      xhr.onload = function() { // Call a function when the state changes.
        let like = document.querySelector("#like-" + publicationId);

        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
          if (this.response == "1")
            like.className = "fas fa-heart";
          else
            like.className = "far fa-heart";
        }
      }
      xhr.send();
      xhr = getXMLHttpRequest();
      xhr.open("GET", "/ajax/check_publication?publicationId=" + publicationId, true);
      xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
      xhr.onload = function() { // Call a function when the state changes.
        let deleteWrapper = document.querySelector("#card-delete-" + publicationId);

        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
          if (this.response == "1")
            deleteWrapper.innerHTML = '<button class="delete" onclick="deletePublication(\'' + publicationId + '\')"></button>';
          else
            deleteWrapper.innerHTML = '';
        }
      }
      xhr.send();
  }
}

function likePublication(publicationId) {
  const xhr = getXMLHttpRequest();

  xhr.open("GET", "/ajax/like?publicationId=" + publicationId, true);
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
  xhr.onload = function() { // Call a function when the state changes.
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      loadingCard(publicationId);
    }
    else {
      window.alert("Can't like this publication.");
    }
  }
  xhr.send();
}

function deletePublication(publicationId) {
  if (window.confirm("Do you really want to delete this publication?")) {
    const xhr = getXMLHttpRequest();

    xhr.open("GET", "/ajax/delete_publication?publicationId=" + publicationId, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onload = function() { // Call a function when the state changes.
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        window.location.replace("/");
      }
      else {
        window.alert("Error.");
      }
    }
    xhr.send();
  }
}

var card = (username, commentary, date, imgPath, publicationId) => {
  let ret,
      likeHTML = "";

  if (isConnect) {
    let onClickHTML = 'onclick="likePublication(\'' + sanitizeHTML(publicationId) + '\')"';

    likeHTML =
      '<div class="media-content-right">\
        <i id="like-' + sanitizeHTML(publicationId) + '" class="far fa-heart" style="color: #FF4545;font-size:24px;" ' + onClickHTML + '></i>\
        <div id="card-delete-' + sanitizeHTML(publicationId) + '" style="display:inline;"></div>\
      </div>';
  }
  ret = '\
  <div id="card-' + sanitizeHTML(publicationId) + '" class="card-wrapper">\
    <div class="card">\
      <div class="card-image"  onclick="location.href=\'/publication?publicationId=' + sanitizeHTML(publicationId) + '\'">\
        <figure class="image is-4by3">\
          <img src=' + sanitizeHTML(imgPath) + ' alt="Placeholder image">\
        </figure>\
      </div>\
      <div class="card-content">\
        <div class="media">\
          <div class="media-content">\
            <p class="title is-4">@' + sanitizeHTML(username) + '</p>\
            <p class="subtitle is-6"><div id="likes-nb-' + sanitizeHTML(publicationId) + '" class="likes-nb">0</div> likes <div id="comments-nb-' + sanitizeHTML(publicationId) + '" class="comments-nb">0</div> comments</p>\
          </div>\
          ' + likeHTML + '\
        </div>\
        <div class="content">\
          <div id="card-comment-' + sanitizeHTML(publicationId) + '">' + sanitizeHTML(commentary) + '</div>\
          <time style="float:right;">' + sanitizeHTML(date) + '</time>\
        </div>\
      </div>\
    </div>\
  </div>'
  return (ret);
}
