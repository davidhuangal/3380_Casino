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

    header("Location: profile.php");
    $status = $_POST["status"];
    require_once 'db.conf';
    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    if ($mysqli->connect_error) {
        print "Error: could not connect to database.";
        exit;
    }
    $query = "SELECT koins FROM users WHERE userName = '$loggedIn'";
    $result = $mysqli->query($query);
    $row = mysqli_fetch_row($result);
    $koins = $row[0];
    if(!$koins){
        print "Error: could not complete database query.";
        exit;
    }
    if($status == 'w'){
        $value = $koins + $_POST["bet"];
    }
    if($status == 'p'){
        $value = $koins;
    }
    if($status == 'l'){
        $value = $koins - $_POST["bet"];
    }
    $query = "UPDATE users SET koins='$value' WHERE userName = '$loggedIn'";
    $mysqli->query($query);
    $query = "SELECT koins FROM users WHERE userName = '$loggedIn'";
    $result = $mysqli->query($query);
    $row = mysqli_fetch_row($result);
    $koins = $row[0];
    $result->close();
    $mysqli->close();
    exit;
?>
