<?php

  if (is_connect() == 0) {
    http_response_code(400);
    exit("You must be connected for delete a comment.");
  }

  if ($_SESSION['username'] && $_POST['newPassword']) {
    $req = $db->prepare('UPDATE Users SET password = :newPassword WHERE username = :username');
    $req->execute(array(':newPassword' => hash_password($_POST['newPassword']),
                        ':username' => $_SESSION['username']));
  }
  exit();

?>
