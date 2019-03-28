<?php

  if ($_GET['email'] && $_GET['mailHash'])
  {
    $req = $db->prepare('SELECT * FROM Users WHERE email = :email');
    $req->execute(array(':email' => $_GET['email']));
    $value = $req->fetchAll();
    if ($value && $value[0] && $value[0]['mailHash'] == $_GET['mailHash'])
    {
      $req = $db->prepare('UPDATE Users SET mailHash = "",
                                  completed = 1 WHERE email = :email');
      $req->execute(array(':email' => $_GET['email']));
      echo 'Your account is now completed.';
    }
  }

?>
