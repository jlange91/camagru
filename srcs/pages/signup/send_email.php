<?php

function send_confirm_mail($email, $pwd, $usr) {
  global $host;
  $hash = hash_email($email, $pwd, $usr);

  $to      = $email;
  $subject = "Welcome to Camagru !";
  $message = "Hi {$usr}

  Please Confirm your account here : http://{$host}/login?email={$email}&mailHash={$hash}";
  $headers = 'From: jlangecamagru@gmail.com' . "\r\n" .
      'X-Mailer: PHP/' . phpversion();

  mail($to, $subject, $message, $headers);
}

?>
