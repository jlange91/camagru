function $_GET(param) {
	var vars = {};
	window.location.href.replace( location.hash, '' ).replace(
		/[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
		function( m, key, value ) { // callback
			vars[key] = value !== undefined ? value : '';
		}
	);

	if ( param ) {
		return vars[param] ? vars[param] : null;
	}
	return vars;
}

const moreButton = document.querySelector("#publication-more-button"),
			publicationId = $_GET("publicationId");
var 	limitComment = 3,
			nbComments = 0;

var moreButtonUpdate = function() {
	var xhr = getXMLHttpRequest();

	xhr = getXMLHttpRequest();
	xhr.open("GET", "/ajax/count_comments?publicationId=" + publicationId, true);
	xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
	xhr.onload = function() { // Call a function when the state changes.
		if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
			const maxComments = parseInt(this.response);

			if (limitComment >= maxComments)
				moreButton.disabled = true;
			else
				moreButton.disabled = false;
		}
	}
	xhr.send();
}

const xhr = getXMLHttpRequest(),
      publicationsWrapper = document.querySelector("#publications-wrapper");

xhr.open("GET", "/ajax/get_publications?limit=1&publicationId=" + publicationId, true);
xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
xhr.onload = function() { // Call a function when the state changes.
	if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
		publicationsWrapper.innerHTML = "";
		publications = JSON.parse(this.responseText);
		publications.forEach(function(pb) {
			publicationsWrapper.innerHTML += card(pb["username"], pb["comment"], pb["date"], pb["path"], pb["uniqid"]);
			loadingCard(pb["uniqid"]);
		});
	}
	else {
		console.log(this.response);
	}
}
xhr.send();

function loadComments() {
  const xhr = getXMLHttpRequest(),
        commentsWrapper = document.querySelector("#comments-wrapper");

  xhr.open("GET", "/ajax/get_comments?limit=" + limitComment + "&publicationId=" + publicationId, true);
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
  xhr.onload = function() { // Call a function when the state changes.
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
			commentsWrapper.innerHTML = "";
      comments = JSON.parse(this.responseText);
      nbComments = 0;
      comments.forEach(function(pb) {
        nbComments++;
        commentsWrapper.innerHTML += getComment(pb["username"], pb["comment"], pb["date"], pb["uniqid"]);
				loadingComment(pb['uniqid']);
      });
    }
    else {
      console.log(this.response);
    }
  }
  xhr.send();
}

loadComments();


window.onload = function() {
	moreButtonUpdate();
}

moreButton.onclick = function() {
	limitComment = limitComment + 3;
	moreButtonUpdate();
	loadComments();
}
