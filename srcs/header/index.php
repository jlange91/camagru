<style><?php include("{$path}/header/index.css"); ?></style>
<script><?php include("{$path}/header/index.js"); ?></script>
<?php
  if(isset($_GET['logout'])) {
    unset($_SESSION['username']);
    unset($_SESSION['password']);
  }
  $buttons = (!is_connect()) ? '
    <a class="button is-primary" href="/signup">
      <strong>Sign up</strong>
    </a>
    <a class="button is-light" href="/login">
      Log in
    </a>' : '
    <a class="button is-primary" href="/profil">
      <i class="material-icons">person</i>
    </a>
    <a class="button is-light" href="?logout">
      Log out
    </a>
  ';
?>
<nav id="header" role="navigation" aria-label="main navigation">
    <a href="/">
      <img id="header-img" src="/assets/camagru2.png" alt="Camagru">
    </a>
    <div id='header-buttons-wrapper'>
      <div id="header-buttons">
        <?php echo $buttons ?>
      </div>
    </div>
</nav>
