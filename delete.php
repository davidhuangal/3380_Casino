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

//End of cited code

    header("Location: logout.php");
    require_once 'db.conf';
    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    if ($mysqli->connect_error) {
        print "Error: could not connect to database.";
        exit;
    }
    $query = "DELETE FROM users WHERE userName = '$loggedIn'";
    $mysqli->query($query);
    $mysqli->close();
    exit;
?>