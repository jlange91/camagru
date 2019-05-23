<?php
  if (is_connect() == 0) {
    http_response_code(400);
    exit("You must be connected for know if you allow sending mail for each comments.");
  }

  if ($_SESSION['username']) {
    $req = $db->prepare('SELECT * FROM Users WHERE username = :username AND sendMailComment = true');
    $req->execute(array(':username' => $_SESSION['username']));
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
