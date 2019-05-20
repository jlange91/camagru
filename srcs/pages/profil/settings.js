const settings = document.createElement('div');

settings.setAttribute("id", "profil-settings");

function loadSettingsProfil() {
  settings.innerHTML = '\
  <ul class="menu-list">\
    <li><a>Team Settings</a></li>\
    <li>\
      <a class="is-active">Manage Your Team</a>\
      <div>\
      rien a foutre\
      </div>\
    </li>\
    <li><a>Invitations</a></li>\
    <li><a>Cloud Storage Environment Settings</a></li>\
    <li><a>Authentication</a></li>\
  </ul>\
  ';
  profil.appendChild(settings);
}

function deleteSettingsProfil() {
    if (settings) {
      settings.innerHTML = "";
    }
}
