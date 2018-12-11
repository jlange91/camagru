<style><?php include("{$path}/header/index.css"); ?></style>
<header>
  <!-- left header menu -->
  <div id='header-lm'>
    <div id='header-lm-ctg'>
      sign in<br/>
      sign up
    </div>
  </div>
  <!-- header menu -->
  <div id='header'>
    <a href='/'><h1 id="header-title">Camagru</h1></a>
    <div id="header-hide">
      <a href='#' id='header-button' onClick='leftMenu();'><i class="material-icons">reorder</i></a>
    </div>
    <div id="header-nhide">
      <?php include("{$path}/header/Categories/index.php") ?>
      <?php include("{$path}/header/Sign/index.php") ?>
    </div>
  </div>
</header>
<script><?php include("{$path}/header/index.js"); ?></script>
