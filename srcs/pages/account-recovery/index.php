<style><?php include("{$path}/pages/account-recovery/index.css"); ?></style>
<?php
  if (is_connect()) {
    echo '<script>document.location.href="/";</script>';
    die("You are already connected.");
  }

  $sendMailForm = '
  <div id="account-recovery-wrapper" class="card">
    <h1 id="account-recovery-title" class="title is-2">Send reset password mail</h1>
    <form id="account-recovery-form" method="get" action="/account-recovery">
      <input name="username" class="input" type="text" placeholder="Username"><br/>
      <input id="account-recovery-send-button" class="button is-primary" type="submit" value="Send" /><br/>
    </form>
  </div>';

  $resetForm = '
  <div id="account-recovery-wrapper">
    <h1 id="account-recovery-title" class="title is-2">Reset Password</h1>
    <input id="new-password" name="password" class="input" type="password" placeholder="New Password" oninput="passwordListener();"><br/>
    <p id="account-recovery-password-warning" class="help is-warning">Add a special character for more security.</p>
    <p id="account-recovery-password-danger" class="help is-danger">Expected at least 6 uppercase, lowercase and numeric characters.</p>
    <input id="new-confirmPassword" name="repeat password" class="input" type="password" placeholder="Confirm New Password" oninput="confirmPasswordListener();"><br/>
    <p id="account-recovery-confirmPassword-danger" class="help is-danger">Expected the same password</p>
    <input type="hidden" name="username" value="' . $_GET["username"] . '">
    <input type="hidden" name="hash" value="' . $_GET["hash"] . '">
    <button id="account-recovery-password-button" class="button is-primary" onclick="sendChangePasswordOnClick();" disabled>Send</div>
  </div>
  ';

  function check_hash($username, $hash) {
    global $db;

    $req = $db->prepare('SELECT * FROM Users WHERE username = :username AND resetPasswordHash = :hash');
    $req->execute(array(':username' => $username,
                        ':hash' => $hash));
    $value = $req->fetchAll();
    return ($value && $value[0]) ? 0 : 1;
  }


  if ($_GET["username"] && $_GET["hash"]) {
    if (check_hash($_GET["username"], $_GET["hash"]))
      echo $sendMailForm . "<div id='account-recovery-error' class='box'>
        <div class='content'>Error bad username or hash.</div>
      </div>";
    else {
      echo "<script>";
      echo include("{$path}/pages/account-recovery/index.js");
      echo "</script>";
      echo $resetForm;
    }
  }
  else if ($_GET["username"]) {
    echo $sendMailForm;
    include("{$path}/pages/account-recovery/send_mail.php");
  }
  else
    echo $sendMailForm;

?>
