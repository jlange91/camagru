const settings = document.createElement('div');

settings.setAttribute("id", "profil-settings");

function sendMailCommentOnLoad() {
  var xhr = getXMLHttpRequest();

  xhr.open("GET", "/ajax/check_send_mail_comment", true);
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
  xhr.onload = function() { // Call a function when the state changes.
    let checkbox = document.querySelector("#send-mail-checkbox");

    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      if (this.response == "1")
        checkbox.checked = true;
      else
        checkbox.checked = false;
    }
  }
  xhr.send();
}

function sendMailCommentOnClick() {
  const xhr = getXMLHttpRequest();

  xhr.open("GET", "/ajax/change_send_mail_comment", true);
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
  xhr.onload = function() { // Call a function when the state changes.
    let checkbox = document.querySelector("#send-mail-checkbox");
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      sendMailCommentOnLoad();
    }
  }
  xhr.send();
}

function sendChangeEmailOnClick() {
  const xhr = getXMLHttpRequest(),
        newEmail = document.querySelector("#new-email").value;

  xhr.open("GET", "/ajax/change_email?newEmail=" + newEmail, true);
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
  xhr.onload = function() { // Call a function when the state changes.
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      window.alert(this.response);
    }
    else {
      console.log(this.response);
    }
  }
  xhr.send();
}

function sendChangeUsernameOnClick() {
  const xhr = getXMLHttpRequest(),
        newUsername = document.querySelector("#new-username").value;

  xhr.open("GET", "/ajax/change_username?newUsername=" + newUsername, true);
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
  xhr.onload = function() { // Call a function when the state changes.
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      window.alert(this.response);
      window.location.href = "/";
    }
    else {
      console.log(this.response);
    }
  }
  xhr.send();
}

function sendChangePasswordOnClick() {
  const xhr = getXMLHttpRequest(),
        newPassword = document.querySelector("#new-password").value;

  xhr.open("POST", "/ajax/change_password", true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.onload = function() { // Call a function when the state changes.
    console.log(this.response);
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      window.alert(this.response);
      window.location.href = "/";
    }
    else {
      console.log(this.response);
    }
  }
  xhr.send("newPassword=" + newPassword);
}

function loadSettingsProfil() {
  settings.innerHTML = '\
  <ul id="settings-tabs" class="menu-list">\
    <li>\
      <a id="settings-general-title" onclick="generalOnClick();">General</a>\
      <div id="settings-general">\
          <input id="send-mail-checkbox" class="checkbox" type="checkbox" onload="sendMailCommentOnLoad();" onclick="sendMailCommentOnClick();"> Enable sending mail for each comments.<br/>\
      </div>\
    </li>\
    <li>\
      <a id="settings-user-title" onclick="changeUserOnClick();">Change username</a>\
      <div id="settings-user">\
        <input id="new-username" name="username" class="input" type="text" placeholder="New Username" oninput="usernameListener();"><br/>\
        <p id="settings-username-danger" class="help is-danger">Expected 4-20 lengths with alphanumeric or .-_ characters</p>\
        <button id="settings-username-button" class="button is-primary" onclick="sendChangeUsernameOnClick();" disabled>Send</div>\
      </div>\
    </li>\
    <li>\
      <a id="settings-password-title" onclick="changePasswordOnClick();">Change password</a>\
      <div id="settings-password">\
        <input id="new-password" name="password" class="input" type="password" placeholder="New Password" oninput="passwordListener();"><br/>\
        <p id="settings-password-warning" class="help is-warning">Add a special character for more security.</p>\
        <p id="settings-password-danger" class="help is-danger">Expected at least 6 uppercase, lowercase and numeric characters.</p>\
        <input id="new-confirmPassword" name="repeat password" class="input" type="password" placeholder="Confirm New Password" oninput="confirmPasswordListener();"><br/>\
        <p id="settings-confirmPassword-danger" class="help is-danger">Expected the same password</p>\
        <button id="settings-password-button" class="button is-primary" onclick="sendChangePasswordOnClick();" disabled>Send</div>\
      </div>\
    </li>\
    <li>\
      <a id="settings-email-title" onclick="changeEmailOnClick();">Change email</a>\
      <div id="settings-email">\
        <input id="new-email" name="email" class="input" type="text" placeholder="New email" oninput="emailListener();"><br/>\
        <p id="settings-email-danger" class="help is-danger">This email is invalid.</p>\
        <button id="settings-email-button" class="button is-primary" onclick="sendChangeEmailOnClick();" disabled>Send</div>\
      </div>\
    </li>\
  </ul>\
  ';
  profil.appendChild(settings);
  sendMailCommentOnLoad();
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

function generalOnClick() {
  const general = document.querySelector('#settings-general'),
        title = document.querySelector('#settings-general-title');

  if (title.className == 'is-active') {
    general.style.display = 'none';
    title.className = '';
  }
  else {
    resetTabsSettings();
    general.style.display = 'block';
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
