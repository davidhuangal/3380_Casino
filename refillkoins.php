<?php

    // Created by Professor Wergeles for CS2830 at the University of Missouri

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

    require_once 'db.conf';
    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    // Failed to connect to database
    if ($mysqli->connect_error) {
        print "Error: could not connect to database.";
        exit;
    }
    // Initializes koins to 500
    $query = "UPDATE users SET koins='500' WHERE userName = '$loggedIn'";
    $mysqli->query($query);
    $query = "SELECT koins FROM users WHERE userName = '$loggedIn'";
    $result = $mysqli->query($query);
    $row = mysqli_fetch_row($result);
    $koins = $row[0];
    print "<h2>$koins</h2>";
    $result->close();
    $mysqli->close();
?>

