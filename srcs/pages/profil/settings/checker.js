var email;
var username;
var password;
var confirmPassword;

function emailChecker() {
  var ret;

  ret = email.match(
    /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
  );
  document.getElementById('new-email').className = ret
    ? 'input is-success'
    : 'input is-danger';
  document.getElementById('settings-email-danger').style.display = ret
    ? 'none'
    : 'block';
  document.getElementById('settings-email-button').disabled = ret
    ? false
    : true;
  return ret;
}

function usernameChecker() {
  var ret;

  ret = username.match(/^[a-zA-Z0-9\.\-\_]{4,20}$/);
  document.getElementById('new-username').className = ret
    ? 'input is-success'
    : 'input is-danger';
  document.getElementById('settings-username-danger').style.display = ret
    ? 'none'
    : 'block';
  document.getElementById('settings-username-button').disabled = ret
    ? false
    : true;
  return ret;
}

function passwordChecker() {
  var ret;

  ret = password.match(
    /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/,
  );
  if (!ret) {
    ret = password.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{6,})/);
    document.getElementById('new-password').className = !ret
      ? 'input is-danger'
      : 'input is-warning';
    document.getElementById('settings-password-warning').style.display = ret
      ? 'block'
      : 'none';
    document.getElementById('settings-password-danger').style.display = ret
      ? 'none'
      : 'block';
  } else {
    document.getElementById('new-password').className = 'input is-success';
    document.getElementById('settings-password-warning').style.display = 'none';
    document.getElementById('settings-password-danger').style.display = 'none';
  }
  return ret;
}

function confirmPasswordChecker() {
  ret = password == confirmPassword ? 1 : 0;
  document.getElementById('new-confirmPassword').className = ret
    ? 'input is-success'
    : 'input is-danger';
  document.getElementById('settings-confirmPassword-danger').style.display = ret
    ? 'none'
    : 'block';
  return ret;
}

function emailListener() {
  email = document.getElementById('new-email').value;
  emailChecker();
}
function usernameListener() {
  username = document.getElementById('new-username').value;
  usernameChecker();
}
function passwordListener() {
  password = document.getElementById('new-password').value;
  passwordChecker();
}
function confirmPasswordListener() {
  confirmPassword = document.getElementById('new-confirmPassword').value;
  confirmPasswordChecker();
}
