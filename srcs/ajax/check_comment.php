<?php

  if ($_SESSION['username'] && $_GET['commentId']) {
    $req = $db->prepare('SELECT * FROM Comments WHERE username = :username AND uniqid = :commentId');
    $req->execute(array(':username' => $_SESSION['username'],
                        ':commentId' => $_GET['commentId']));
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
