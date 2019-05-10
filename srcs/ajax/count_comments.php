<?php
  $nbComments = 0;

  if ($_GET['publicationId']) {
    $req = $db->prepare('SELECT * FROM Comments WHERE publicationId = :publicationId');
    $req->execute(array(':publicationId' => $_GET['publicationId']));
    $resp = $req->fetchAll();
    foreach ($resp as $value){
      $nbComments += 1;
    }
  }
  echo $nbComments;
  http_response_code(200);
  exit();

?>
