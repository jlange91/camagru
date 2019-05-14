<?php

  if (is_connect() == 0) {
    http_response_code(400);
    exit("You must be connected for like publication.");
  }

  if ($_SESSION['username'] && $_GET['publicationId']) {
    $req = $db->prepare('SELECT * FROM Likes WHERE username = :username AND publicationId = :publicationId');
    $req->execute(array(':username' => $_SESSION['username'],
                        ':publicationId' => $_GET['publicationId']));
    $resp = $req->fetchAll();
    echo $req->fetchAll();
    if (empty($resp)) {
      $req = $db->prepare('INSERT INTO Likes (publicationId, username) VALUES (:publicationId, :username)');
      $req->execute(array(':username' => $_SESSION['username'],
                          ':publicationId' => $_GET['publicationId']));
    }
    else {
      $req = $db->prepare('DELETE FROM Likes WHERE username = :username AND publicationId = :publicationId');
      $req->execute(array(':username' => $_SESSION['username'],
                          ':publicationId' => $_GET['publicationId']));
    }
  }
  http_response_code(200);
  exit();

?>
