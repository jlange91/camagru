<?php

  if ($_GET['limit'] && $_GET['publicationId']) {
    $limit = intval($_GET['limit']);
        $req = $db->prepare('SELECT * FROM (SELECT * FROM Comments WHERE publicationId = :publicationId ORDER BY date DESC LIMIT :limit) sub ORDER BY date ASC');
        $req->execute(array(':publicationId' => $_GET['publicationId'],
                            ':limit' => $limit));
        $resp = $req->fetchAll();
        echo json_encode($resp);
  }
  exit();

?>
