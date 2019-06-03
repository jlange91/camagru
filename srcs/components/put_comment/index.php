<style><?php include("{$path}/components/put_comment/index.css"); ?></style>
<div id="commentary">
  <input disabled  maxlength="3" size="3" value="255" id="counter">
  <textarea id="commentary-text" maxlength="255" class="textarea" placeholder="e.g. Hello world" oninput="textCounter(this,'counter',255);"></textarea>
  <input id="commentary-button" class="button is-primary" type="submit" value="Send" />
</div>
<script><?php include("{$path}/components/put_comment/index.js"); ?></script>
