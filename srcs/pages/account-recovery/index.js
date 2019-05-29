var confirmPassword;

function sendChangePasswordOnClick() {
  const xhr = getXMLHttpRequest(),
        newPassword = document.querySelector("#new-password").value;

  xhr.open("POST", "/ajax/reset_password", true);
  xhr.setRequestHeader("Content-Type", "application/json");
  xhr.onload = function() { // Call a function when the state changes.
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      window.alert(this.response);
      window.location.href = "/login";
    }
    else {
      console.log(this.response);
    }
  }
  xhr.send(JSON.stringify({
    username: $_GET('username'),
    hash: $_GET('hash'),
    password: newPassword,
  }));
}

function confirmPasswordChecker() {
  ret = password == confirmPassword ? 1 : 0;
  document.getElementById('new-confirmPassword').className = ret
    ? 'input is-success'
    : 'input is-danger';
  document.getElementById('account-recovery-confirmPassword-danger').style.display = ret
    ? 'none'
    : 'block';
  return ret;
}

function checkPasswordButton() {
  const button = document.getElementById('account-recovery-password-button');
  button.disabled = (passwordChecker() && confirmPasswordChecker()) ? false : true;
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
    document.getElementById('account-recovery-password-warning').style.display = ret
      ? 'block'
      : 'none';
    document.getElementById('account-recovery-password-danger').style.display = ret
      ? 'none'
      : 'block';
  } else {
    document.getElementById('new-password').className = 'input is-success';
    document.getElementById('account-recovery-password-warning').style.display = 'none';
    document.getElementById('account-recovery-password-danger').style.display = 'none';
  }
  return ret;
}

function passwordListener() {
  password = document.getElementById('new-password').value;
  passwordChecker();
  checkPasswordButton()
}

function confirmPasswordListener() {
  confirmPassword = document.getElementById('new-confirmPassword').value;
  confirmPasswordChecker();
  checkPasswordButton()
}
