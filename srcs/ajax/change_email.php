<?php

  if (is_connect() == 0) {
    http_response_code(400);
    exit("You must be connected for delete a comment.");
  }

  if ($_SESSION['username'] && $_GET['newEmail']) {
    $req = $db->prepare('UPDATE Users SET email = :newEmail, mailHash = :mailHash WHERE username = :username');
    $req->execute(array(':newEmail' => $_GET['newEmail'],
                        ':mailHash' => hash_email($_GET['newEmail']),
                        ':username' => $_SESSION['username']));
  }
  exit();

?>
