<?php

  if (is_connect() == 0) {
    http_response_code(400);
    exit("You must be connected for delete a comment.");
  }

  $errStr = "Bad Request.";

  function passwordChecker() {
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{6,})/', $_POST['newPassword'])) {
      $errStr = "This password is invalid format.";
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

  if ($_SESSION['username'] && $_POST['newPassword'] && !passwordChecker()) {
    $req = $db->prepare('UPDATE Users SET password = :newPassword WHERE username = :username');
    $req->execute(array(':newPassword' => hash_password($_POST['newPassword']),
                        ':username' => $_SESSION['username']));
  }
  else
    exit($errStr);
  exit("Your password has been change.");

?>
