<?php
  $nbLikes = 0;

  if ($_GET['publicationId']) {
    $req = $db->prepare('SELECT * FROM Likes WHERE publicationId = :publicationId');
    $req->execute(array(':publicationId' => $_GET['publicationId']));
    $resp = $req->fetchAll();
    foreach ($resp as $value){
      $nbLikes += 1;
    }
  }
  echo $nbLikes;
  http_response_code(200);
  exit();

?>
