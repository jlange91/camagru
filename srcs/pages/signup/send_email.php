<?php
  function send_confirm_mail($email) {
    global $host;
    global $db;

    $req = $db->prepare('SELECT * FROM Users WHERE email = :email AND sendMailDate <  NOW()');
    $req->execute(array(':email' => $email));
    $value = $req->fetchAll();
    if ($value && $value[0]) {
      if ($value[0]['completed'] != 0)
        return (1);
      $hash = $value[0]['mailHash'];
      $usr = $value[0]['username'];
    }
    else
      return (2);
    $to      = $email;
    $subject = "Welcome to Camagru !";
    $message = "Hi {$usr}

    Please Confirm your account here : http://{$host}/login?email={$email}&mailHash={$hash}";
    $headers = 'From: jlangecamagru@gmail.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    if (mail($to, $subject, $message, $headers))
    {
      $req = $db->prepare('UPDATE Users SET sendMailDate = :sendMailDate WHERE email = :email');
      $req->execute(array(':email' => $email,
                          ':sendMailDate' => date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s")." +2 minutes"))));
    }
    else
      return (3);
    return (0);
  }

?>
