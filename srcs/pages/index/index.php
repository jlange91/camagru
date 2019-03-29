<style><?php include("{$path}/pages/index/index.css"); ?></style>
<div id="index-wrapper">
  <?php
    if (is_connect())
      echo "
      <a id='index-add' class='box button is-primary' href='/post'>
        <i class='material-icons'>add_circle_outline</i>
      </a>
      ";
  ?>
  <?php include("{$path}/components/card/index.php"); ?>
  <?php include("{$path}/components/card/index.php"); ?>
  <?php include("{$path}/components/card/index.php"); ?>
  <?php include("{$path}/components/card/index.php"); ?>
</div>
