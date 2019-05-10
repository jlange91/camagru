<?php

  if (is_connect() == 0) {
    http_response_code(400);
    exit("You must be connected for comment publication.");
  }

  if ($_SESSION['username'] && $_GET['publicationId'] && $_GET['comment']) {
      $req = $db->prepare('INSERT INTO Comments (date, comment, username, publicationId) VALUES (:date, :comment, :username, :publicationId)');
      $req->execute(array(':date' => date("Y-m-d H:i:s"),
                          ':comment' => $_GET['comment'],
                          ':username' => $_SESSION['username'],
                          ':publicationId' => $_GET['publicationId']));
  }
  http_response_code(200);
  exit();

?>
