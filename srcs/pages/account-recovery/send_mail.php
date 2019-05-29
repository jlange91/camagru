<?php

  function send_reset_password($username) {
    global $host;
    global $db;

    $req = $db->prepare('SELECT * FROM Users WHERE username = :username AND sendMailDate <  NOW()');
    $req->execute(array(':username' => $username));
    $value = $req->fetchAll();
    if ($value && $value[0]) {
      $usr = $value[0]['username'];
      $email = $value[0]['email'];
    }
    else
      return (2);
    $hash = substr(bin2hex(random_bytes(256)), 0, 256);
    $to      = $email;
    $subject = "Reset password from Camagru";
    $message = "Hi {$usr}

    Please reset your password here : http://{$host}/account-recovery?username={$username}&hash={$hash}";
    $headers = 'From: jlangecamagru@gmail.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    if (mail($to, $subject, $message, $headers))
    {
      $req = $db->prepare('UPDATE Users SET sendMailDate = :sendMailDate, resetPasswordHash = :resetPasswordHash WHERE email = :email');
      $req->execute(array(':email' => $email,
                          ':sendMailDate' => date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s")." +2 minutes")),
                          ':resetPasswordHash' => $hash));
    }
    else
      return (3);
    return (0);
  }

  $ret = send_reset_password($_GET['username']);
  if ($ret != 0) {
    switch ($ret) {
      case '2':
        $strError = "You can send an email only every 2 minutes.";
        break;
      default:
        $strError = "An error occurred while sending the mail.";
        break;
    }
    echo "<div id='account-recovery-error' class='box'>
      <div class='content'>" . $strError . "</div>
    </div>";
  }
  else {
    echo "<div id='account-recovery-success' class='box'>
      <div class='content'>An email has been sent to reset your password.</div>
    </div>";
  }

?>
