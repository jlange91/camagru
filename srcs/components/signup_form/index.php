<style><?php include("{$path}/components/signup_form/index.css"); ?></style>
<script language='javascript'><?php include("{$path}/components/signup_form/index.js"); ?></script>
<div id="signup-wrapper" class="card">
  <h1 id="signup-title" class="title is-2">Sign Up</h1>
  <form id="signup-form" method="post" action="/signup">
    <input id="signup-email" name="email" class="input" type="email" placeholder="Email" oninput="emailListener();"><br/>
    <p id="signup-email-danger" class="help is-danger">This email is invalid.</p>
    <input id="signup-username" name="username" class="input" type="text" placeholder="Username" oninput="usernameListener();"><br/>
    <p id="signup-username-danger" class="help is-danger">4 lengths alphanumeric characters minimum with . or _ in middle.</p>
    <input id="signup-password" name="password" class="input" type="password" placeholder="Password" oninput="passwordListener();"><br/>
    <p id="signup-password-warning" class="help is-warning">Add a special character for more security.</p>
    <p id="signup-password-danger" class="help is-danger">Passwords must have at least 6 uppercase, lowercase and numeric characters.</p>
    <input id="signup-confirmPassword" name="confirmPassword" class="input" type="password" placeholder="Confirm Password" oninput="confirmPasswordListener();"><br/>
    <p id="signup-confirmPassword-danger" class="help is-danger">Not the same password</p>
    <input id="signup-send-button" class="button is-primary" type="submit" value="Sign up" disabled />
  </form>
  <div>Have an account? <a href="/login">Log in</a></div>
</div>
