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

const xhr = getXMLHttpRequest(),
      publicationsWrapper = document.querySelector("#publications-wrapper");

xhr.open("GET", "/ajax/get_publications?limit=1&publicationId=" + $_GET('publicationId'), true);
xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
xhr.onload = function() { // Call a function when the state changes.
  if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
    publications = JSON.parse(this.responseText);
    nbFiles = 0;
    htmlPublications = "";
    publications.forEach(function(pb) {
      nbFiles++;
      htmlPublications += card(pb["username"], pb["comment"], pb["date"], pb["path"]);
    });
    publicationsWrapper.innerHTML = htmlPublications;
  }
  else {
    console.log(this.response);
  }
}
xhr.send();
