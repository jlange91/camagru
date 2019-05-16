<?php

if (is_connect() == 0) {
  http_response_code(400);
  exit("You must be connected for delete a publication.");
}

function checkPublication() {
  global $db;

  $req = $db->prepare('SELECT * FROM Publications WHERE username = :username AND uniqid = :publicationId');
  $req->execute(array(':username' => $_SESSION['username'],
                      ':publicationId' => $_GET['publicationId']));
  $resp = $req->fetchAll();
  if (empty($resp))
    return false;
  else
    return true;
}

if ($_SESSION['username']  && $_GET['publicationId']) {
  if (!checkPublication()) {
    http_response_code(400);
    exit("Your account can't delete this publication.");
  }
  $req = $db->prepare('DELETE FROM Likes WHERE publicationId = :publicationId');
  $req->execute(array(':publicationId' => $_GET['publicationId']));
  $req = $db->prepare('DELETE FROM Comments WHERE publicationId = :publicationId');
  $req->execute(array(':publicationId' => $_GET['publicationId']));
  $req = $db->prepare('DELETE FROM Publications WHERE username = :username AND uniqid = :publicationId');
  $req->execute(array(':username' => $_SESSION['username'],
                      ':publicationId' => $_GET['publicationId']));
}
exit();

?>
