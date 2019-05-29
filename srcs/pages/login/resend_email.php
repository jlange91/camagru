<?php

  if ($_GET['resendEmail'])
  {
    $ret = send_confirm_mail($_GET['resendEmail']);
    if ($ret != 0) {
      switch ($ret) {
        case '1':
          $strError = "Account already completed.";
          break;
        case '2':
          $strError = "You can send an email only every 2 minutes.";
          break;
        default:
          $strError = "An error occurred while sending the mail.";
          break;
      }
      echo "<div id='login-error' class='box'>
        <div class='content'>" . $strError . "</div>
      </div>";
    }
    else {
      echo "<div id='login-success' class='box'>
        <div class='content'>An email has been sent to confirm your registration.</div>
      </div>";
    }
  }

?>
