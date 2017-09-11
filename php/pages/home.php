<link href="/css/home.css" rel="stylesheet">
<div class="app">
	<div class="top">
		<h1>Lode Runner</h1>
		<p>
			Lode Runner is a game made by Vincent Voet as his project for his study Media- and Application Development at MBO Utrecht in Utrecht, The Netherlands
		</p>
		<p>
			To play lode runner you have to be logged in and have verified your e-mail adres
		</p>
		<br>
		<br>
		<a class="gotoGame btn" href="/game">Play Lode Runner</a>

	</div>
	<div class="bottom">
		<div class="left">
			<h1>Login</h1>
			<div>
				<form id="loginForm" action="./php/login/login.php" method="POST" enctype="multipart/form-data">
					<label for="username">Username</label>
					<input placeholder="Username" type="text" name="username" autofocus></input>
					<label for="password">Password</label>
					<input placeholder="Password" type="password" name="password"></input>
					<input type="submit" value="Login" name="login">
				</form>
			</div>
		</div>
		<div class="center">
			<p> - OR - </p>
		</div>
		<div class="right">
			<h1>Register</h1>
			<div id="register">
				<form id="registerForm" action="./php/login/register.php" method="POST" enctype="multipart/form-data">
					<label for="username">Username</label><input placeholder="Username" type="text" name="username"><br>
					<label for="password">Password</label><input type="password" name="password"><br>
					<label for="confpassword">Confirm Password</label><input type="password" name="confpassword"><br>
					<label for="email">E-mail</label><input placeholder="example@example.com" type="text" name="email"><br>
							<input type="submit" value="Register" name="submit">
				</form>
			</div>
		</div>
	</div>
</div>