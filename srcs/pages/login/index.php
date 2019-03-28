<style><?php include("{$path}/pages/login/index.css"); ?></style>
<?php
  if (is_connect())
    echo '<script>document.location.href="/";</script>';
  $loginForm = '
  <div id="login-wrapper" class="card">
    <h1 id="login-title" class="title is-2">Log In</h1>
    <form id="login-form" method="post" action="/login">
      <input name="username" class="input" type="text" placeholder="Username"><br/>
      <input name="password" class="input" type="password" placeholder="Password"><br/>
      <input id="login-send-button" class="button is-primary" type="submit" value="Log in" />
    </form>
  </div>';
  if ($_POST['username'] || $_POST['password'])
  {
    $req = $db->prepare('SELECT * FROM Users WHERE username = :username');
    $req->execute(array(':username' => $_POST['username']));
    $value = $req->fetchAll();
    if ($value && $value[0]['password'] == hash_password($_POST['password']))
    {
      $_SESSION['username'] = $_POST['username'];
      $_SESSION['password'] = $_POST['password'];
      echo '<script>document.location.href="/";</script>';
    }
    else if ($value)
    {
      echo $loginForm . "
      <div id='login-error' class='box'>
        <div class='content'>Sorry, your password was incorrect. Please double-check your password.</div>
      </div>";
    }
    else
    {
      echo $loginForm . "
      <div id='login-error' class='box'>
        <div class='content'>The username you entered doesn't belong to an account. Please check your username and try again.</div>
      </div>";
    }
  }
  else
    echo $loginForm;
?>
