<?php
    require_once(realpath(__DIR__ . '/../util/db.php'));

    if (!isset($_GET['token']) || empty($_GET['token'])) {
        die('Er ging iets fout!');
    }

    $token = strip_tags($_GET['token']);
    $token = stripslashes($token);
    $token = mysqli_real_escape_string($sql, $token);

    // echo $token.'<br><br>';

    $query = "SELECT username, verified FROm `user` WHERE verificationtoken = '$token' LIMIT 1";
    if(!$result = mysqli_query($sql, $query)){
        die($sql->error);
    }

    if(!$row = mysqli_fetch_array($result)) {
        die("Er ging iets fout!");
    }

    // var_dump($row);

    if($row['verified'] == 1) {
        die("Gebruiker is al geverifieerd");
    }

    if($row['verified'] == 0){
        $query = "UPDATE `user` SET verified = '1' WHERE verificationtoken = '$token'";
        if(!$result = mysqli_query($sql, $query)){
            die($sql->error);
        }else{
        	?>
           <link href="/css/verify.css" rel="stylesheet">
			<div class="verify">
				<p>Succes! The user <?php echo $row['username']; ?> is now verified!</p>
				<a class="login btn" href="/">Play Lode Runner</a>
			</div>
			<?php
        }
    }
    // var_dump($row);
?>
