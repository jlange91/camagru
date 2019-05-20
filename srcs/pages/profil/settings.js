const settings = document.createElement('div');

settings.setAttribute("id", "profil-settings");

function loadSettingsProfil() {
  settings.innerHTML = '\
  <div id="profil-settings-tittle-username">Change username.</div>\
  <div id="profil-settings-tittle-cp">Change password.</div>\
  <div id="profil-settings-tittle-mail">Change mail.</div>\
  ';
  profil.appendChild(settings);
}

function deleteSettingsProfil() {
    if (settings) {
      settings.innerHTML = "";
    }
}
