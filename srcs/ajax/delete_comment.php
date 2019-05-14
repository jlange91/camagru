<?php

  if (is_connect() == 0) {
    http_response_code(400);
    exit("You must be connected for delete a comment.");
  }

  if ($_SESSION['username'] && $_GET['commentId']) {
    $req = $db->prepare('DELETE FROM Comments WHERE username = :username AND uniqid = :commentId');
    $req->execute(array(':username' => $_SESSION['username'],
                        ':commentId' => $_GET['commentId']));
  }
  exit();

?>
