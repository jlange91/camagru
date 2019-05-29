<?php

  $errStr = "Bad Request.";


  $data = json_decode(file_get_contents('php://input'), true);
  $username = $data["username"];
  $hash = $data["hash"];
  $password = hash_password($data["password"]);

  function passwordChecker() {
    global $errStr;
    global $data;

    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{6,})/', $data["password"])) {
      $errStr = "This password is invalid format.";
      return (1);
    }
    return (0);
    // /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{6,})/
    //   └────┬────┘└───┬─────┘└─────┬───┘└───────┘
    //        │         │            │         │
    //        │         │            │         │
    //        │         │            │         The string must be 6 characters or longer
    //        │         │            │
    //        │         │            The string must contain at least 1 numeric character
    //        │         │
    //        │         The string must contain at least 1 uppercase alphabetical character
    //        │
    //        The string must contain at least 1 lowercase alphabetical character
    //^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})
  }

  if (!passwordChecker()) {
    $req = $db->prepare('SELECT * FROM Users WHERE username = :username AND resetPasswordHash = :hash');
    $req->execute(array(':username' => $username,
                        ':hash' => $hash));
    $value = $req->fetchAll();
    if ($value && $value[0]) {
        $req = $db->prepare("UPDATE Users SET password = :password, resetPasswordHash = '' WHERE username = :username");
        $req->execute(array(':username' => $username,
                            ':password' => $password));
    }
    else
      exit ($errStr);
  }
  else
    exit($errStr);
  exit("Your password has been change.");

?>
