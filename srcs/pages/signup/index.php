<style><?php include("{$path}/pages/signup/index.css"); ?></style>
<?php
  include("{$path}/pages/signup/send_email.php");
  if (is_connect())
    echo '<script>document.location.href="/";</script>';
  include("{$path}/components/signup_form/index.php");

  $strError = "Error in the form :<br/><br/>";

  function printFormError() {
    global $strError;

    echo "
    <div id='signup-error' class='box'>
      <div class='content'>" .
        $strError ."
      </div>
    </div>";
  }

  function emailChecker() {
    global $strError;
    global $db;

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $strError = $strError . "Email Error.<br/>";
      return (1);
    }
    $req = $db->prepare('SELECT email FROM Users WHERE email = :email');
    $req->execute(array(':email' => $_POST['email']));
    $value = $req->fetchAll();
    if ($value)
    {
      $strError = $strError . "Email already use.<br/>";
      return (1);
    }
    return (0);
  }

  function usernameChecker() {
    global $strError;
    global $db;

    if (!preg_match('/^[a-zA-Z0-9\.\-\_]{4,20}$/', $_POST['username'])) {
      $strError = $strError . "Username Error.<br/>";
      return (1);
    }
    $req = $db->prepare('SELECT username FROM Users WHERE username = :username');
    $req->execute(array(':username' => $_POST['username']));
    $value = $req->fetchAll();
    if ($value)
    {
      $strError = $strError . "Username already use.<br/>";
      return (1);
    }
    return (0);
    // /^(?=.{4,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/
    //  └─────┬────┘└───┬──┘└─────┬─────┘└─────┬─────┘ └───┬───┘
    //        │         │         │            │           no _ or . at the end
    //        │         │         │            │
    //        │         │         │            allowed characters
    //        │         │         │
    //        │         │         no __ or _. or ._ or .. inside
    //        │         │
    //        │         no _ or . at the beginning
    //        │
    //        username is 4-20 characters long
  }

  function passwordChecker() {
    global $strError;

    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{6,})/', $_POST['password'])) {
      $strError = $strError . "Password Error.<br/>";
      return (1);
    }
    return (0);
    // /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{6,})/
    //   └────┬────┘└───┬─────┘└─────┬───┘└───────┘
    //        │         │            │         │
    //        │         │            │         │
    //        │         │            │         The string must be 6 characters or longer
    //        │         │            │
    //        │         │            The string must contain at least 1 numeric character
    //        │         │
    //        │         The string must contain at least 1 uppercase alphabetical character
    //        │
    //        The string must contain at least 1 lowercase alphabetical character
    //^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})
  }

  function confirmPasswordChecker() {
    global $strError;

    if ($_POST['password'] == $_POST['confirmPassword'])
      return (0);
    else {
      $strError = $strError . "Confirm password Error.<br/>";
      return (1);
    }
  }

  if ($_POST['email'] || $_POST['username'] || $_POST['password'] || $_POST['confirmPassword'])
  {
    $fails = 0;
    $fails += emailChecker();
    $fails += usernameChecker();
    $fails += passwordChecker();
    $fails += confirmPasswordChecker();
    if ($fails === 0)
    {
      $req = $db->prepare('INSERT INTO Users (email, username, password, completed, mailHash, sendMailDate) VALUES (:email,:username,:password,0,:mailHash,:sendMailDate)');
      $req->execute(array(':email' => $_POST['email'],
                        ':username' => $_POST['username'],
                        ':password' => hash_password($_POST['password']),
                        ':mailHash' => hash_email($_POST['email'], $_POST['password'], $_POST['username']),
                        ':sendMailDate' => date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s")." -2 minutes"))));
      send_confirm_mail($_POST['email']);
      echo "
      <div id='signup-success' class='box'>
        <div class='content'>
          An email has been sent to confirm your registration.
        </div>
      </div>";
    }
    else
      printFormError();
  }
?>
