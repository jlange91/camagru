<?php

  if ($_GET['limit']) {
    $limit = intval($_GET['limit']);
    $req = $db->prepare('SELECT * FROM Publications ORDER BY date DESC LIMIT :limit');
    $req->execute(array(':limit' => $limit));
    $resp = $req->fetchAll();
    foreach ($resp as $key => $value){
      $resp[$key]["path"] = str_replace("/var/www/", "/", $value["path"]);
    }
    echo json_encode($resp);
  }
  exit();

?>
