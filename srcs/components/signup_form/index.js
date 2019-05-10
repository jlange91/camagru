var email;
var username;
var password;
var confirmPassword;

function buttonChecker() {
  if (
    email && emailChecker() &&
    username && usernameChecker() &&
    password && passwordChecker() &&
    confirmPassword && confirmPasswordChecker()
  ) {
    document.getElementById('signup-send-button').disabled = false;
  } else document.getElementById('signup-send-button').disabled = true;
}

function emailChecker() {
  var ret;

  ret = email.match(
    /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
  );
  document.getElementById('signup-email').className = ret
    ? 'input is-success'
    : 'input is-danger';
  document.getElementById('signup-email-danger').style.display = ret
    ? 'none'
    : 'block';
  return ret;
}

function usernameChecker() {
  var ret;

  ret = username.match(/^[a-zA-Z0-9\.\-\_]{4,20}$/);
  document.getElementById('signup-username').className = ret
    ? 'input is-success'
    : 'input is-danger';
  document.getElementById('signup-username-danger').style.display = ret
    ? 'none'
    : 'block';
  return ret;
}

function passwordChecker() {
  var ret;

  ret = password.match(
    /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/,
  );
  if (!ret) {
    ret = password.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{6,})/);
    document.getElementById('signup-password').className = !ret
      ? 'input is-danger'
      : 'input is-warning';
    document.getElementById('signup-password-warning').style.display = ret
      ? 'block'
      : 'none';
    document.getElementById('signup-password-danger').style.display = ret
      ? 'none'
      : 'block';
  } else {
    document.getElementById('signup-password').className = 'input is-success';
    document.getElementById('signup-password-warning').style.display = 'none';
    document.getElementById('signup-password-danger').style.display = 'none';
  }
  return ret;
}

function confirmPasswordChecker() {
  ret = password == confirmPassword ? 1 : 0;
  document.getElementById('signup-confirmPassword').className = ret
    ? 'input is-success'
    : 'input is-danger';
  document.getElementById('signup-confirmPassword-danger').style.display = ret
    ? 'none'
    : 'block';
  return ret;
}

function emailListener() {
  email = document.getElementById('signup-email').value;
  emailChecker();
  buttonChecker();
}
function usernameListener() {
  username = document.getElementById('signup-username').value;
  usernameChecker();
  buttonChecker();
}
function passwordListener() {
  password = document.getElementById('signup-password').value;
  passwordChecker();
  buttonChecker();
}
function confirmPasswordListener() {
  confirmPassword = document.getElementById('signup-confirmPassword').value;
  confirmPasswordChecker();
  buttonChecker();
}
