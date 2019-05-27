<?php

  if (is_connect() == 0) {
    http_response_code(400);
    exit("You must be connected for comment publication.");
  }


  if ($_SESSION['username'] && $_GET['publicationId'] && $_GET['comment'] && $_GET['comment'].length < 256) {
      $req = $db->prepare('INSERT INTO Comments (date, comment, username, publicationId, uniqid) VALUES (:date, :comment, :username, :publicationId, :uniqid)');
      $req->execute(array(':date' => date("Y-m-d H:i:s"),
                          ':comment' => ($_GET['comment']) ? $_GET['comment'] : "",
                          ':username' => $_SESSION['username'],
                          ':publicationId' => $_GET['publicationId'],
                          ':uniqid' => uniqid()));
  }
  exit();

?>
