<?php

  require('pdo.php');
  $urlpage = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
  $page = array('/' => 'pages/index/index.php',
                '/test' => 'pages/test/index.php');

?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="index.css" />
    <title> Camagru </title>
  </head>
  <body>
    <?php include('header/index.php'); ?>
    <?php include(($page[$urlpage]) ? ($page[$urlpage]) : ('404.php')); ?>
    <?php include('footer/index.php'); ?>
  </body>
</html>
