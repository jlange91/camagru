<?php

  if ($_SESSION['username'] && $_GET['publicationId']) {
    $req = $db->prepare('SELECT * FROM Publications WHERE username = :username AND uniqid = :publicationId');
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
