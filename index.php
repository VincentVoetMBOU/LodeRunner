<?php
	/*
	* Home page that imports code of other pages
	*/
	include_once('./php/util/db.php');
	session_start();
?>
<!-- <!DOCTYPE html> -->
<html>
	<head>
		<title>Loderunner</title>
		<link href="/css/main.css" rel="stylesheet">
	</head>
	<body>
        <header>
            <a href="/">Home</a>
            <a href="/ladders">Ladders</a>
            <a href="/game">Lode runner</a>
            <div class="isLoggedIn">
                <?php
                    if(isset($_SESSION['id'])){
                        echo "<span>Logged in as: ". $_SESSION['username'].'</span><a href="/logout">Logout</a>';
                    }
                ?>
            </div>
        </header>
		<div id="bodyContent">
			<?php
			if(isset($_GET['page'])){
				$pages = array(
                    'logout' => 'logout.php',
                    'verify' => 'verify.php',
                    'game' => '../../game/index.php',
                    'ladders' => 'ladders.php',
					'' => 'home.php'
				);
				
				$url = rtrim(strtolower($_GET['page']), "/");

				if(array_key_exists($url, $pages)){
					require './php/pages/'.$pages[$url];
				}else{
					require './php/pages/404.php';
				}
			}else{
				require './php/pages/home.php';
			}
			?>
		</div>
	</body>
</html>
