<?php

  if (is_connect() == 0) {
    http_response_code(400);
    exit("You must be connected for delete a comment.");
  }

  $errStr = "Bad Request";

  function usernameChecker() {
    global $db;
    global $errStr;

    if (!preg_match('/^[a-zA-Z0-9\.\-\_]{4,20}$/', $_GET['newUsername'])) {
      $errStr = "This username is invalid format.";
      return (1);
    }
    $req = $db->prepare('SELECT username FROM Users WHERE username = :username');
    $req->execute(array(':username' => $_GET['newUsername']));
    $value = $req->fetchAll();
    if ($value)
    {
      $errStr = "This username is already use.";
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

  if ($_SESSION['username'] && $_GET['newUsername'] && !usernameChecker()) {
    $req = $db->prepare('UPDATE Users SET username = :newUsername WHERE username = :username');
    $req->execute(array(':newUsername' => $_GET['newUsername'],
                        ':username' => $_SESSION['username']));
    $req = $db->prepare('UPDATE Publications SET username = :newUsername WHERE username = :username');
    $req->execute(array(':newUsername' => $_GET['newUsername'],
                        ':username' => $_SESSION['username']));
    $req = $db->prepare('UPDATE Comments SET username = :newUsername WHERE username = :username');
    $req->execute(array(':newUsername' => $_GET['newUsername'],
                        ':username' => $_SESSION['username']));
    $req = $db->prepare('UPDATE Likes SET username = :newUsername WHERE username = :username');
    $req->execute(array(':newUsername' => $_GET['newUsername'],
                        ':username' => $_SESSION['username']));
  }
  else
    exit($errStr);
  exit("Your username has been change.");

?>
