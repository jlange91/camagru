<style> <?php include("{$path}/pages/profil/index.css"); ?></style>
<div id="profil">
  <?php echo '<div style="text-align:center;">@' . $_GET["username"] . ' Profil</div>' ?>
  <div class="tabs is-centered">
    <ul id="profil-menu-wrapper">
      <li id="profil-menu-0" class="is-active"><a>Pictures</a></li>
      <?php
        if (is_connect() && $_SESSION["username"] == $_GET["username"]) {
          echo '<li id="profil-menu-1"><a>Settings</a></li>';
        }
      ?>

    </ul>
  </div>
</div>
<script> <?php include("{$path}/pages/profil/pictures.js"); ?></script>
<script> <?php include("{$path}/pages/profil/settings/checker.js"); ?></script>
<script> <?php include("{$path}/pages/profil/settings/index.js"); ?></script>
<script> <?php include("{$path}/pages/profil/index.js"); ?></script>
