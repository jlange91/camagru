<?php

function usernameChecker() {
  return (!preg_match('/^(?=.{4,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/', $_POST['username'])) ? 0 : 1;
                      //  └─────┬────┘└───┬──┘└─────┬─────┘└─────┬─────┘ └───┬───┘
                      //        │         │         │            │           no _ or . at the end
                      //        │         │         │            │
                      //        │         │         │            allowed characters
                      //        │         │         │
                      //        │         │         no __ or _. or ._ or .. inside
                      //        │         │
                      //        │         no _ or . at the beginning
                      //        │
                      //        username is 4-20 characters long
}

function passwordChecker() {
    return (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{6,})/', $_POST['password'])) ? 0 : 1;
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

if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && usernameChecker() && passwordChecker())
{
  $req = $db->prepare('INSERT INTO Users (email, username, password, completed) VALUES (:email,:username,:password,0)');
  $req->execute(array(':email' => $_POST['email'],
                    ':username' => $_POST['username'],
                    ':password' => $_POST['password']));
}
if ($_POST['username'] && !passwordChecker())
  echo "mauvais password";
 ?>
<?php include("{$path}/components/signup_form/index.php"); ?>
