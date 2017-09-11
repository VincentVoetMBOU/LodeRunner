<?php
    // echo '<script>console.log("db");</script>';
    $sql = mysqli_connect("localhost", "USERNAME", "PASSWORD", "DATABASENAME");
    if (mysqli_connect_errno()) {
    	printf("Connect failed: %s\n", mysqli_connect_error());
    	exit();
    }
    $domain = "http://localhost";
?>
