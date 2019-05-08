var card = (username, commentary, date, imgPath) => {
  return ('\
  <div id="card-wrapper">\
    <div class="card">\
      <div class="card-image">\
        <figure class="image is-4by3">\
          <img src=' + imgPath + ' alt="Placeholder image">\
        </figure>\
      </div>\
      <div class="card-content">\
        <div class="media">\
          <div class="media-content">\
            <p class="title is-4">@' + username + '</p>\
          </div>\
        </div>\
        <div class="content">\
          ' + commentary + '\
          <br>\
          <time>' + date + '</time>\
        </div>\
      </div>\
    </div>\
  </div>');
}
