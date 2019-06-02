<?php

  if (is_connect() == 0) {
    http_response_code(400);
    exit("You must be connected for comment publication.");
  }

  function send_mail($to) {
    global $host;
    global $db;

    if ($to) {
      $hash = $value[0]['mailHash'];
      $usr = $to['username'];
    }
    else
      return (1);
    $dest      = $to['email'];
    $subject = "Camagru notification !";
    $message = "Hi {$usr}

    {$_SESSION['username']} comment your publication here : http://{$host}/publication?publicationId={$_GET['publicationId']}";
    $headers = 'From: jlangecamagru@gmail.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    if (!mail($dest, $subject, $message, $headers))
      return (2);
    return (0);
  }

  function check_send_mail($to) {
    global $db;

    $req = $db->prepare('SELECT sendMailComment FROM Users WHERE username = :username');
    $req->execute(array(':username' => $_SESSION['username']));
    $resp = $req->fetch(PDO::FETCH_ASSOC);
    return ($to['sendMailComment'] === 1 && $to['username'] != $_SESSION['username']) ? 1 : 0;
  }


  if ($_SESSION['username'] && $_GET['publicationId'] && $_GET['comment'] && strlen($_GET['comment']) < 256) {
    $req = $db->prepare('SELECT * FROM Users WHERE username = (SELECT username FROM Publications WHERE uniqid = :uniqid)');
    $req->execute(array(':uniqid' => $_GET['publicationId']));
    $resp = $req->fetchAll();
    if (empty($resp)) {
      exit();
    }
    else {

        $req = $db->prepare('INSERT INTO Comments (date, comment, username, publicationId, uniqid) VALUES (:date, :comment, :username, :publicationId, :uniqid)');
        $req->execute(array(':date' => date("Y-m-d H:i:s"),
                            ':comment' => ($_GET['comment']) ? $_GET['comment'] : "",
                            ':username' => $_SESSION['username'],
                            ':publicationId' => $_GET['publicationId'],
                            ':uniqid' => uniqid()));

      if (check_send_mail($resp[0]))
        send_mail($resp[0]);
    }
  }
  exit();

?>
