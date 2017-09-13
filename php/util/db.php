<?php
    // echo '<script>console.log("db");</script>';
    $sql = mysqli_connect("localhost", "loderunner2", "NZbjCRsvaPTRMnYY", "loderunner");
    if (mysqli_connect_errno()) {
    	printf("Connect failed: %s\n", mysqli_connect_error());
    	exit();
    }
    $domain = "http://localhost";
?>
