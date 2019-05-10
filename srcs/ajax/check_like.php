<?php
  if (is_connect() == 0) {
    http_response_code(400);
    exit("You must be connected for know if you like publication.");
  }

  $nbLikes = 0;

  if ($_SESSION['username'] && $_GET['publicationId']) {
    $req = $db->prepare('SELECT * FROM Likes WHERE username = :username AND publicationId = :publicationId');
    $req->execute(array(':username' => $_SESSION['username'],
                        ':publicationId' => $_GET['publicationId']));
    $resp = $req->fetchAll();
    if (empty($resp))
      $nbLikes = 0;
    else
      $nbLikes = 1;
  }
  echo $nbLikes;
  exit();

?>
