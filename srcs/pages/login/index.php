<style><?php include("{$path}/pages/login/index.css"); ?></style>
<div id="login-wrapper" class="card">
  <h1 id="login-title" class="title is-2">Log In</h1>
  <form id="login-form" method="post" action="/">
    <input name="username" class="input" type="text" placeholder="Username"><br/>
    <input name="password" class="input" type="password" placeholder="Password"><br/>
    <input id="login-send-button" class="button is-primary" type="submit" value="Log in" />
  </form>
</div>
