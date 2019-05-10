<style><?php include("{$path}/pages/publication/index.css"); ?></style>
<div id="index-wrapper">
  <?php
    echo "<script>var isConnect = false;</script>";

    if (is_connect())
      echo "<script>isConnect = true;</script>";
  ?>
  <div id="publications-wrapper">
  </div>
  <div id="comments-wrapper">
  </div>
  <?php
    include("{$path}/components/get_comment/index.php");
    include("{$path}/components/get_comment/index.php");
    if (is_connect())
      include("{$path}/components/put_comment/index.php");
  ?>
  <?php include("{$path}/components/card/index.php"); ?>
</div>
<script><?php include("{$path}/pages/publication/index.js"); ?></script>
<script><?php include("{$path}/pages/publication/send_request.js"); ?></script>
