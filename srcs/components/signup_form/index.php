<style><?php include("{$path}/components/signup_form/index.css"); ?></style>
<div id="signup-wrapper" class="card">
  <h1 id="signup-title" class="title is-2">Sign Up</h1>
  <form id="signup-form" method="post" action="/signup">
    <input name="email" class="input" type="email" placeholder="Email"><br/>
    <input name="username" class="input" type="text" placeholder="Username"><br/>
    <input name="password" class="input" type="password" placeholder="Password"><br/>
    <input name="confirmPassword" class="input" type="password" placeholder="Confirm Password"><br/>
    <input id="signup-send-button" class="button is-primary" type="submit" value="Sign up" />
  </form>
  <div>Have an account? <a href="/login">Log in</a></div>
</div>
