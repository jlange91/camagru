const settings = document.createElement('div');

settings.setAttribute("id", "profil-settings");

function loadSettingsProfil() {
  settings.innerHTML = '\
  <ul id="settings-tabs" class="menu-list">\
    <li>\
      <a id="settings-user-title" onclick="changeUserOnClick();">Change username</a>\
      <div id="settings-user">\
        <input name="username" class="input" type="text" placeholder="New Username"><br/>\
        <button id="user-send-button" class="button is-primary">Send</div>\
      </div>\
    </li>\
    <li>\
      <a id="settings-password-title" onclick="changePasswordOnClick();">Change password</a>\
      <div id="settings-password">\
        <input name="username" class="input" type="text" placeholder="New Password"><br/>\
        <input name="username" class="input" type="text" placeholder="Confirm New Password"><br/>\
        <button id="user-send-button" class="button is-primary">Send</div>\
      </div>\
    </li>\
    <li>\
      <a id="settings-email-title" onclick="changeEmailOnClick();">Change email</a>\
      <div id="settings-email">\
        <input name="username" class="input" type="text" placeholder="New email"><br/>\
        <button id="user-send-button" class="button is-primary">Send</div>\
      </div>\
    </li>\
  </ul>\
  ';
  profil.appendChild(settings);
}

function deleteSettingsProfil() {
    if (settings) {
      settings.innerHTML = "";
    }
}

function changeUserOnClick() {
  const user = document.querySelector('#settings-user'),
        title = document.querySelector('#settings-user-title');

  if (title.className == 'is-active') {
    user.style.display = 'none';
    title.className = '';
  }
  else {
    resetTabsSettings();
    user.style.display = 'block';
    title.className = 'is-active';
  }
}

function changePasswordOnClick() {
  const password = document.querySelector('#settings-password'),
        title = document.querySelector('#settings-password-title');

  if (title.className == 'is-active') {
    password.style.display = 'none';
    title.className = '';
  }
  else {
    resetTabsSettings();
    password.style.display = 'block';
    title.className = 'is-active';
  }
}

function changeEmailOnClick() {
  const email = document.querySelector('#settings-email'),
        title = document.querySelector('#settings-email-title');

  if (title.className == 'is-active') {
    email.style.display = 'none';
    title.className = '';
  }
  else {
    resetTabsSettings();
    email.style.display = 'block';
    title.className = 'is-active';
  }
}

function resetTabsSettings() {
  childs = document.querySelector("#settings-tabs").childNodes;

  [].forEach.call(childs, function(child) {
    if (child.childNodes[1] && child.childNodes[3])
      if (child.childNodes[1].className == 'is-active') {
        child.childNodes[3].style.display = 'none';
        child.childNodes[1].className = '';
      }
  });
}
