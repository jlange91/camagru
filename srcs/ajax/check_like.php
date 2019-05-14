<?php
  if (is_connect() == 0) {
    http_response_code(400);
    exit("You must be connected for know if you like publication.");
  }

  if ($_SESSION['username'] && $_GET['publicationId']) {
    $req = $db->prepare('SELECT * FROM Likes WHERE username = :username AND publicationId = :publicationId');
    $req->execute(array(':username' => $_SESSION['username'],
                        ':publicationId' => $_GET['publicationId']));
    $resp = $req->fetchAll();
    if (empty($resp))
      echo 0;
    else
      echo 1;
  }
  else {
    echo 0;
  }
  exit();

?>
