<?php

  if (is_connect() == 0) {
    http_response_code(400);
    exit("You must be connected for delete a comment.");
  }

  $errStr = "Bad Request";

  function emailChecker() {
    global $db;
    global $errStr;

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $errStr = "This email is invalid format.";
      return (1);
    }
    $req = $db->prepare('SELECT email FROM Users WHERE email = :email');
    $req->execute(array(':email' => $_POST['email']));
    $value = $req->fetchAll();
    if ($value) {
      $errStr = "This email is already use.";
      return (1);
    }
    return (0);
  }

  if ($_SESSION['username'] && $_GET['newEmail'] && !emailChecker()) {
    $req = $db->prepare('UPDATE Users SET email = :newEmail, mailHash = :mailHash WHERE username = :username');
    $req->execute(array(':newEmail' => $_GET['newEmail'],
                        ':mailHash' => hash_email($_GET['newEmail']),
                        ':username' => $_SESSION['username']));
  }
  else
    exit($errStr);
  exit("Your email has been change.");

?>
