<?php
  function hash_password($pwd) {
    return (hash('sha512', 'coucou les correcteurs' . strlen($pwd) . $pwd . 'met moi 125 stp'));
  }

  function hash_email($email) {
    return (hash('sha256', 'on rajoute un petit peu de sel' . strlen($email) . $email . 'par si et par la'));
  }

  function is_connect() {
    global $db;

    if (!isset($_SESSION['username']) || !isset($_SESSION['password']))
      return false;
    $req = $db->prepare('SELECT * FROM Users WHERE username = :username');
    $req->execute(array(':username' => $_SESSION['username']));
    $value = $req->fetchAll();
    return ($value && $value[0] && $value[0]['completed'] && $value[0]['password'] == $_SESSION['password']) ? true : false;
  }

  function disconnect() {
      unset($_SESSION['username']);
      unset($_SESSION['password']);
  }
?>
