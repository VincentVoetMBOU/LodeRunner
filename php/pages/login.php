<?php
	if(!isset($_SESSION['id'])){
		echo '<meta http-equiv="refresh" content="0; url=/" />';
		//echo '<script>window.location.href="/user/'.$_SESSION['username'].'"</script>';
		die();
	}
?>

<h1>Login</h1>
<div>
  <form id="loginForm" action="./php/login/login.php" method="POST" enctype="multipart/form-data">
    <input placeholder="Username" type="text" name="username" autofocus></input>
    <input placeholder="Password" type="password" name="password"></input>
    <input type="submit" value="Login" name="login">
  </form>
</div>

<h1>Register</h1>
<div id="register">
	<form id="registerForm" action="./php/login/register.php" method="POST" enctype="multipart/form-data">
		Username: 	<input placeholder="Username" type="text" name="username"><br>
		Password: 	<input type="password" name="password"><br>
		Confirm Password: 	<input type="password" name="confpassword"><br>
		E-mail: 	<input placeholder="example@example.com" type="text" name="email"><br>
				<input type="submit" value="Register" name="submit">
	</form>
</div>
