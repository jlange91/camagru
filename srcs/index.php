<?php

  session_start();
  require('pdo.php');
  require('connection.php');
  $urlpage = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
  $path = '/var/www';
  $page = array('/' => "{$path}/pages/index/index.php",
                '/signup' => "{$path}/pages/signup/index.php",
                '/login' => "{$path}/pages/login/index.php",
                '/post' => "{$path}/pages/post/index.php",
                '/install' => "{$path}/install.php");

?>
<style><?php include("{$path}/bulma/bulma.min.css"); ?></style>
<style><?php include("{$path}/index.css"); ?></style>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="/assets/camagru_icon.png" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title> Camagru </title>
  </head>
  <body>
    <?php include("{$path}/header/index.php"); ?>
    <?php include(($page[$urlpage]) ? ($page[$urlpage]) : ('404.php')); ?>
  </body>
</html>
