<?php
// Created by Professor Wergeles for CS2830 at the University of Missouri



	// Every time we want to access $_SESSION, we have to call session_start()
	if(!session_start()) {
		header("Location: error.php");
		exit;
	}
	
	$loggedIn = empty($_SESSION['loggedin']) ? false : $_SESSION['loggedin'];
	if (!$loggedIn) {
		header("Location: login.php");
		exit;
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Kyle's Kasino</title>
    <link rel="stylesheet" href="style.css">
    <link href="jquery-ui-1.11.4.custom/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <style>
        #disppane{
            text-align: center;
            margin: auto;
            margin-top: 200px;
            height: 400px;
            border: solid;
            width: 600px;
            background-color: darkgray;
            border-radius: 30px;
        }
    </style>
    <script src="jquery-ui-1.11.4.custom/external/jquery/jquery.js"></script>
    <script src="jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
    <script>
        $(function(){
            $("input[type=submit]").button();
        });
        
        
        $(document).ready(function(){
            $('#menu').load('menu.html');
            $('#koincount').load('getkoins.php');
            $("#refill").click(function() {
                $('#koincount').load('refillkoins.php');
            });
        });
    </script>
</head>
<body>
    <div id="menu"></div>
    <div id="disppane" class="widget">
        <h2>Logged in as: <?php print "$loggedIn"; ?></h2>
        <br>
        <h3>Kyle Koin balance:</h3>
        <div id="koincount"></div>
        <button id="refill" type="button">Reset Kyle Koins</button>
        <br>
        <br>
        <h3>Select your display name:</h3>
        <form action="loggedgame.php" method="get">
            <input type="text" placeholder="Enter Display Name" name="dname" required>
            <button type="submit">Play!</button>
        </form>
    </div>
    
</body>
</html>