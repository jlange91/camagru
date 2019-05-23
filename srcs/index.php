<?php

  session_start();
  require('pdo.php');
  require('connection.php');
  $urlpage = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
  $path = '/var/www';
  $page = array("/" => "{$path}/pages/index/index.php",
                "/signup" => "{$path}/pages/signup/index.php",
                "/login" => "{$path}/pages/login/index.php",
                "/post" => "{$path}/pages/post/index.php",
                "/publication" => "{$path}/pages/publication/index.php",
                "/profil" => "{$path}/pages/profil/index.php",
                "/install" => "{$path}/install.php");
  $ajaxPage = array("/ajax/post" => "{$path}/ajax/post.php",
                    "/ajax/like" => "{$path}/ajax/like.php",
                    "/ajax/comment" => "{$path}/ajax/comment.php",
                    "/ajax/check_like" => "{$path}/ajax/check_like.php",
                    "/ajax/check_comment" => "{$path}/ajax/check_comment.php",
                    "/ajax/check_publication" => "{$path}/ajax/check_publication.php",
                    "/ajax/check_send_mail_comment" => "{$path}/ajax/check_send_mail_comment.php",
                    "/ajax/get_publications" => "{$path}/ajax/get_publications.php",
                    "/ajax/get_publications_user" => "{$path}/ajax/get_publications_user.php",
                    "/ajax/get_comments" => "{$path}/ajax/get_comments.php",
                    "/ajax/count_comments" => "{$path}/ajax/count_comments.php",
                    "/ajax/count_likes" => "{$path}/ajax/count_likes.php",
                    "/ajax/delete_publication" => "{$path}/ajax/delete_publication.php",
                    "/ajax/delete_comment" => "{$path}/ajax/delete_comment.php",
                    "/ajax/change_username" => "{$path}/ajax/change_username.php",
                    "/ajax/change_password" => "{$path}/ajax/change_password.php",
                    "/ajax/change_send_mail_comment" => "{$path}/ajax/change_send_mail_comment.php",
                    "/ajax/change_email" => "{$path}/ajax/change_email.php");

  if ($ajaxPage[$urlpage])
    include($ajaxPage[$urlpage]);

?>
<style><?php include("{$path}/bulma/bulma.min.css"); ?></style>
<style><?php include("{$path}/index.css"); ?></style>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="/assets/camagru_icon.png" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <script> <?php include("{$path}/get_xml_http_request.js"); ?> </script>
    <script><?php include("{$path}/index.js"); ?></script>
    <title> Camagru </title>
  </head>
  <body>
    <?php include("{$path}/header/index.php"); ?>
    <?php include(($page[$urlpage]) ? ($page[$urlpage]) : ('404.php')); ?>
  </body>
</html>
