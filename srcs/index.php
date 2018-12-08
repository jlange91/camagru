<?php

  require('pdo.php');
  $urlpage = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
  $page = array('/' => 'pages/index/index.php',
                '/test' => 'pages/test/index.php');

?>
<html>
  <body>
    <?php require('header/index.php'); ?>
    <?php ($page[$urlpage]) ? require($page[$urlpage]) : die("404 Error"); ?>
  </body>
</html>
