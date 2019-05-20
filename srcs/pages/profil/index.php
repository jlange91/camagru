<style> <?php include("{$path}/pages/profil/index.css"); ?></style>
<div id="profil">
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
<script> <?php include("{$path}/pages/profil/settings.js"); ?></script>
<script> <?php include("{$path}/pages/profil/index.js"); ?></script>
