<?php
if ($_POST['email'] && $_POST['username'] && $_POST['password'] && $_POST['confirmPassword'])
{
  echo $_POST['email'];
}
 ?>
<?php include("{$path}/components/signup_form/index.php"); ?>
