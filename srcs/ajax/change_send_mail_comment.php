<?php

  if (is_connect() == 0) {
    http_response_code(400);
    exit("You must be connected for delete a comment.");
  }

  if ($_SESSION['username']) {
    $req = $db->prepare('UPDATE Users SET sendMailComment = NOT sendMailComment WHERE username = :username');
    $req->execute(array(':username' => $_SESSION['username']));
  }
  exit();

?>
