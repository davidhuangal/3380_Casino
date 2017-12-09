<?php
// Created by Professor Wergeles for CS2830 at the University of Missouri 

// Account creation added by Kyle Moore.


	// Here we are using sessions to propagate the login
	// http://us3.php.net/manual/en/intro.session.php

	
	// http://us3.php.net/manual/en/function.session-start.php
	if(!session_start()) {
		// If the session couldn't start, present an error
		header("Location: error.php");
		exit;
	}
	
	
	// Check to see if the user has already logged in
	$loggedIn = empty($_SESSION['loggedin']) ? false : $_SESSION['loggedin'];
	
	if ($loggedIn) {
		header("Location: profile.php");
		exit;
	}
	
	
	$action = empty($_POST['action']) ? '' : $_POST['action'];
	
	if ($action == 'do_login') {
		handle_login();
	} else {
		login_form();
	}
	
	function handle_login() {
		$username = empty($_POST['username']) ? '' : $_POST['username'];
		$password = empty($_POST['password']) ? '' : $_POST['password'];
		
		 $email= empty($_POST['email']) ? '' : $_POST['email'];
	
        /*
		if ($username == "test" && $password == "pass") {
			// Instead of setting a cookie, we'll set a key/value pair in $_SESSION
			$_SESSION['loggedin'] = $username;
			header("Location: page1.php");
			exit;
		}
        */
        
        // We added the test user to our users table
        // INSERT INTO users (username, password, addDate, changeDate) VALUES ('test', 'pass', NOW(), NOW());
        
        // Require the credentials
        require_once 'db.conf';
        
        // Connect to the database
        $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
        
        // Check for errors
        if ($mysqli->connect_error) {
            $error = 'Error: ' . $mysqli->connect_errno . ' ' . $mysqli->connect_error;
			require "login_form.php";
            exit;
        }
        
        // http://php.net/manual/en/mysqli.real-escape-string.php
        $username = $mysqli->real_escape_string($username);
        $password = $mysqli->real_escape_string($password);
	$email= $mysqli->real_escape_string($email);
        
        //more secure password storing for website
        $password = sha1($password); 
        
        // Build query
		$query = "SELECT id FROM users WHERE userName = '$username' AND password = '$password'";
		
        // Sometimes it's nice to print the query. That way you know what SQL you're working with.
        //print $query;
        //exit;
        
		// Run the query
		$mysqliResult = $mysqli->query($query);
		
        // If there was a result...
        if ($mysqliResult) {
            // How many records were returned?
            $match = $mysqliResult->num_rows;

            // Close the results
            $mysqliResult->close();
            // Close the DB connection
            $mysqli->close();


            // If there was a match, login
  		    if ($match == 1) {
                $_SESSION['loggedin'] = $username;
                header("Location: profile.php");
                exit;
            }
            else {
                $mysqli2 = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
                $query2 = "SELECT id FROM users WHERE userName = '$username'";
                $mysqliResult2 = $mysqli2->query($query2);
                $match2 = $mysqliResult2->num_rows;
                if ($match2 == 1) {
                    // Incorrect password
                    $error = 'Incorrect password';
                    require "login_form.php";
                    $mysqliResult2->close();
                    $mysqli2->close();
                    exit;
                }
                else{
                    $mysqli3 = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
		    $query3 = "INSERT INTO users (username, password, koins) VALUES('$username', '$password', '500')";
                    $mysqli3->query($query3);
		    $query3 = "INSERT INTO emails (email) VALUES('$email')";
                    $mysqli3->query($query3);
                    $_SESSION['loggedin'] = $username;
                    header("Location: profile.php");
                    $mysqliResult3->close();
                    $mysqli3->close();
                    exit;
                }
            }
        }
        // Else, there was no result
        else {
          $error = 'Login Error: Please contact the system administrator.';
          require "login_form.php";
          exit;
        }
	}
	
	function login_form() {
        // Initial login form
		$username = "";
		$error = "";
		require "login_form.php";
        exit;
	}
?>
