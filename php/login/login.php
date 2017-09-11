<?php
	/*
	 * Login handler to test password to login
	*/

  session_start();

    function hashPass($pass){
        $salt = '';
        $saltCharacters = array_merge(range('a', 'z'), range('A', 'Z'), range(0, 9));
        for ($i=0; $i < 25; $i++) {
            $salt .= $saltCharacters[array_rand($saltCharacters)];
        }
        return crypt($pass, sprintf('$2y$%02d$', 9) . $salt);
    }

    function validatePass($pass, $hashedPass){
        return crypt($pass, $hashedPass) == $hashedPass;
    }

    if(isset($_POST['login']) && !isset($_SESSION['id'])){
        require_once(realpath(__DIR__ . '/../util/db.php'));

        $username = strip_tags($_POST['username']);
        $password = strip_tags($_POST['password']);
        $username = stripslashes($username);
        $password = stripslashes($password);
        $username = mysqli_real_escape_string($sql, $username);
        $password = mysqli_real_escape_string($sql, $password);

        $query = "SELECT * FROM user WHERE username = '$username' LIMIT 1";
        // var_dump($sql);

        if (!$result = mysqli_query($sql, $query)) {
            echo 'failed';
            die($sql->error);
        }

        $row = mysqli_fetch_array($result);

        $id = $row['id'];
        $db_password = $row['passwordhash'];
        $verified = $row['verified'];

        if(validatePass($password, $db_password)){
            if ($verified != 1) {
                die('Verifier eerst je account via de ontvangen email!');
            }
            
        	$_SESSION['username'] = $username;
        	$_SESSION['id'] = $id;
        	echo '<script> window.location.href = "/"; </script>';
        }else{
        	echo 'password is incorrect';
        }
    }else{
    	echo 'you are already logged in';
    }
?>
