<?php

  if (is_connect() == 0) {
    http_response_code(400);
    exit("You must be connected for delete a comment.");
  }

  if ($_SESSION['username'] && $_GET['newUsername']) {
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
  else {
      http_response_code(400);
      exit("New username is not set.");
  }
  exit();

?>
