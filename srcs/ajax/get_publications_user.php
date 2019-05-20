<?php

  if ($_GET['username']) {
    $limit = ($_GET["limit"]) ? intval($_GET['limit']) : 0;
    $req = $db->prepare('SELECT * FROM Publications WHERE username = :username ORDER BY date DESC LIMIT :limit');
    $req->execute(array(':username' => $_GET['username'],
                        ':limit' => $limit));
    $resp = $req->fetchAll();
    foreach ($resp as $key => $value){
      $resp[$key]["path"] = str_replace("/var/www/", "/", $value["path"]);
    }
    echo json_encode($resp);
  }
  exit();

?>
