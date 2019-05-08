var limit = 5;
var nbFiles = 0;

function loadPublications() {
  const xhr = getXMLHttpRequest(),
        publicationsWrapper = document.querySelector("#publications-wrapper");

  xhr.open("GET", "/ajax/get_publications?limit=" + limit, true);
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
  xhr.onload = function() { // Call a function when the state changes.
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      publications = JSON.parse(this.responseText);
      nbFiles = 0;
      htmlPublications = "";
      publications.forEach(function(pb) {
        nbFiles++;
        htmlPublications += card(pb["userId"], pb["comment"], pb["date"], pb["path"]);
      });
      publicationsWrapper.innerHTML = htmlPublications;
    }
    else {
      window.alert(this.response);
    }
  }
  xhr.send();
}

window.onscroll = function() {
  const windowHeight = "innerHeight" in window ? window.innerHeight : document.documentElement.offsetHeight;
  const body = document.body;
  const html = document.documentElement;
  const docHeight = Math.max(body.scrollHeight, body.offsetHeight, html.clientHeight,  html.scrollHeight, html.offsetHeight);
  const windowBottom = windowHeight + window.pageYOffset + 1;

  if (windowBottom >= docHeight) {
    if (nbFiles == limit) {
      limit += 5;
      loadPublications();
    }
  }
};

loadPublications();
