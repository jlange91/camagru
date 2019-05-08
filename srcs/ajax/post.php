<?php

  $data = json_decode(file_get_contents('php://input'), true);
  $img = $data["imgBase64"];
  $commentary = $data["commentary"];
  $filterId = $data["filterId"];
  $xOffset = $data["xOffset"];
  $yOffset = $data["yOffset"];

  if (!$img || !isset($filterId) || !isset($xOffset) || !isset($yOffset)) {
    http_response_code(400);
    exit("Error while uploading image.");
  }
  if (!$img = base64_decode(explode(',', substr( $img , 5 ) , 2)[1])) {
      http_response_code(400);
      exit("Error while uploading image.");
  }

  function save_imagepng($img,$fname){
    ob_start();// store output
    imagePNG($img);// output to buffer
    file_put_contents($fname, ob_get_contents(), FILE_BINARY);// write buffer to file
    ob_end_clean();// clear and turn off buffer
  }


  $filterImage = imagecreatefrompng("{$path}/assets/filters/filter" . $filterId . ".png");
  $image = imagecreatefromstring($img);

  if (!$image || !$filterImage) {
      http_response_code(400);
      exit("Error while uploading image.");
  }

  // Copie le cachet sur la photo en utilisant les marges et la largeur de la
  // photo originale  afin de calculer la position du cachet

  if ($filterId != "0")
    imagecopy($image, $filterImage, 0 + $xOffset, 0 + $yOffset, 0, 0, imagesx($filterImage), imagesy($filterImage));
  $uniqid = uniqid();
  $imagePath = "{$path}/assets/publication/" . $uniqid . ".png";

    $req = $db->prepare('SELECT * FROM Users WHERE username = :username');
    $req->execute(array(':username' => $_SESSION['username']));
    $userId = $req->fetchAll()[0]['guid'];
  $req = $db->prepare('INSERT INTO Publications (date, path, userId, comment, uniqid) VALUES (:date, :path, :userId, :comment, :uniqid)');
  $req->execute(array(
                    ':date' => date("Y-m-d H:i:s"),
                    ':path' => $imagePath,
                    ':userId' => $userId,
                    ':comment' => $commentary,
                    ':uniqid' => $uniqid));
  save_imagepng($image, $imagePath);
  http_response_code(200);
  exit();

?>
