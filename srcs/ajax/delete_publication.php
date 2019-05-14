<?php

if (is_connect() == 0) {
  http_response_code(400);
  exit("You must be connected for delete a publication.");
}

if ($_SESSION['username']  && $_GET['publicationId']) {
  $req = $db->prepare('DELETE FROM Likes WHERE username = :username');
  $req->execute(array(':username' => $_SESSION['username']));
  $req = $db->prepare('DELETE FROM Comments WHERE username = :username');
  $req->execute(array(':username' => $_SESSION['username']));
  $req = $db->prepare('DELETE FROM Publications WHERE username = :username AND uniqid = :publicationId');
  $req->execute(array(':username' => $_SESSION['username'],
                      ':publicationId' => $_GET['publicationId']));
}
exit();

?>
