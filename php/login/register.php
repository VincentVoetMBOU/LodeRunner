<?php
    //include db file
    require_once(realpath(__DIR__ . '/../util/db.php'));

    //init pretty variables from post request
    $username =  $_POST['username'];
    $password =  $_POST['password'];
    $confpassword =  $_POST['confpassword'];
    $email =  $_POST['email'];

    function hashPass($pass){
        $salt = '';
        $saltCharacters = array_merge(range('a', 'z'), range('A', 'Z'), range(0, 9));
        for ($i=0; $i < 25; $i++) {
            $salt .= $saltCharacters[array_rand($saltCharacters)];
        }
        return crypt($pass, sprintf('$2y$%02d$', 9) . $salt);
    }

    function validateRegister($username, $password, $confpassword, $email, $sql){
        $errors = "";
        
        //$errors = null;
        //test if username is taken
        if(!is_null(mysqli_fetch_array(mysqli_query($sql, "SELECT username FROM user WHERE username ='$username' LIMIT 1"))['username'])){
            $errors .= 'That username is already taken!<br><br>';
        }

        //test if email is taken
        if(!is_null(mysqli_fetch_array(mysqli_query($sql, "SELECT email FROM user WHERE email ='$email' LIMIT 1"))['email'])){
            $errors .= 'That email is already in use!<br><br>';
        }

        //test password
        //if(!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password)){
        //  $errors .= 'The password:<br>Must be between 8 and 20 characters<br>Must at least have one letter<br>Must have at least one special character<br>Must at least have 1 Capitalized letter<br><br>';
        //}
        if(strlen($password) < 6){
            $errors .= 'password too short<br><br>';
        }
        //test username
        if(!preg_match("/^[\w-]+$/", $username)){
            $errors .= 'The username can only contain Letters, numbers, underscores and hyphens<br><br>';
        }

        //test confpass
        if($password != $confpassword){
            $errors .= 'Your confimed password does not match your password<br><br>';
        }

        //test email
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors .= 'Please enter a valid email adress';
        }
        // var_dump($errors);
        //handle return
        if($errors == ""){
            // echo 'no errors';
            return "no_errors";
        }else{
            // echo 'errors';
            return $errors;
        }
    }

    //make pass hash
    // $passhash = password_hash($password, PASSWORD_DEFAULT);

    //test if all info is correct insert into db if it is and if not display the errors
    $validate = validateRegister($username, $password, $confpassword, $email, $sql);
    if($validate == "no_errors"){

        $passwordhash = hashPass($password);

        $preToken = $username.$email;
        $split = str_split($preToken);
        shuffle($split);
        $verificationToken = implode(preg_replace('/[^A-Za-z0-9\-]/', '', $split));

        //make vars save against SQL injection
        $username = mysqli_real_escape_string($sql, stripslashes(strip_tags($username)));
        $email = mysqli_real_escape_string($sql, stripslashes(strip_tags($email)));
        $passwordhash = mysqli_real_escape_string($sql, stripslashes(strip_tags($passwordhash)));
        $verificationtoken = mysqli_real_escape_string($sql, stripslashes(strip_tags($verificationToken)));

        $query = "INSERT INTO `user` (`id`, `username`, `email`, `passwordhash`, `verificationtoken`, `verified`) VALUES (NULL, '$username', '$email', '$passwordhash', '$verificationtoken', '0')";
        if(mysqli_query($sql, $query) === true){
            echo '<div class="success">Your account has been successfully created! Please verify your email!</div>';
            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=iso-8859-1';
            if(!mail($email, "Lode Runner account verificatie", "Verifieer uw account via deze link: "+$domain+"/verify&token=".$verificationtoken, implode("\r\n", $headers))){
                die('Mail error');
            }
        }else{
            echo '<div class="error">db error</div>';
        }
    }else{
        echo '<div class="error">'.$validate.'</div>';
    }
?>
