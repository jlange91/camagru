<?php

  require('pdo.php');
  $urlpage = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
  $page = array('/' => 'pages/index/index.php',
                '/test' => 'pages/test/index.php');

?>
<html>
  <body>
    <?php include('header/index.php'); ?>
    <?php include(($page[$urlpage]) ? ($page[$urlpage]) : ('404.php')); ?>
    <?php include('footer/index.php'); ?>
  </body>
</html>
