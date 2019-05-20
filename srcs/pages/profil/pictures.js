const pictures = document.createElement('div');

pictures.setAttribute("id", "profil-pictures");
document.querySelector("body").appendChild(pictures);

var limit = 5;
var nbFiles = 0;

function profilImage(path, publicationId) {
  return ('\
  <div class="card profil-image">\
    <div class="card-image"  onclick="location.href=\'/publication?publicationId=' + sanitizeHTML(publicationId) + '\'">\
      <figure class="image is-4by3">\
        <img src=' + sanitizeHTML(path) + ' alt="Placeholder image">\
      </figure>\
    </div>\
  </div>');
}

function loadingPicturesProfil() {
  const xhr = getXMLHttpRequest(),
        pictures = document.querySelector("#profil-pictures");

  xhr.open("GET", "/ajax/get_publications_user?username=" + $_GET("username") + "&limit=" + limit, true);
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
  xhr.onload = function() { // Call a function when the state changes.
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      pictures.innerHTML = "";
      publications = JSON.parse(this.responseText);
      nbFiles = 0;
      publications.forEach(function(pb) {
        nbFiles++;
        pictures.innerHTML += profilImage(pb["path"], pb["uniqid"]);
      });
      profil.appendChild(pictures);
      reloadPictures();
    }
    else {
      console.log(this.response);
    }
  }
  xhr.send();
}

function reloadPictures() {
  const windowHeight = "innerHeight" in window ? window.innerHeight : document.documentElement.offsetHeight;
  const body = document.body;
  const html = document.documentElement;
  const docHeight = Math.max(body.scrollHeight, body.offsetHeight, html.clientHeight,  html.scrollHeight, html.offsetHeight);
  const windowBottom = windowHeight + window.pageYOffset + 1;

  if (windowBottom + 100 >= docHeight) {
    if (nbFiles == limit) {
      limit += 5;
      loadingPicturesProfil();
    }
  }
}

function loadPicturesProfil() {
  loadingPicturesProfil();
  window.onscroll = function() { reloadPictures() };
}

function deletePicturesProfil() {
  if (pictures) {
    pictures.innerHTML = "";
  }
  window.onscroll = function() {};
}
