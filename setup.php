<?php
	//Include global variables
	include_once('core/options.php');
	
	//Initiate MySQLi Connection
	$mysqli = new mysqli($options['mysql_host'], $options['mysql_user'], $options['mysql_pass']);
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error . "\n";
	}

	//Create Database
	if (!$mysqli->query("CREATE DATABASE " . $options['mysql_database'] . " DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci")) {
		echo "Error creating database: " . $mysqli->error . "\n";
	} else {
		echo "Database created\n";

		//Select Database
		if (!$mysqli->query("USE " . $options['mysql_database'])) {
			echo "Error selecting database '" . $options['mysql_database'] . "': " . $mysqli->error . "\n";
		} else {
			echo "Database selected\n";

			//Begin Creating Tables
			
			//Create Images table
			if (!$mysqli->query("CREATE TABLE images (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY, path VARCHAR(4096) NOT NULL, origfile VARCHAR(255), uploader INT(4) UNSIGNED, views INT(8) UNSIGNED, timestamp TIMESTAMP, tags VARCHAR(49152), description TEXT)")) {
				echo "Error creating table 'images': " . $mysqli->error . "\n";
			} else {
				echo "Table 'images' created\n";
			}

			//Create Users table
			if (!$mysqli->query("CREATE TABLE users (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY, username VARCHAR(60) NOT NULL, password VARCHAR(255) NOT NULL, active BOOLEAN DEFAULT 1, timestamp TIMESTAMP)")) {
				echo "Error creating table 'users': " . $mysqli->error . "\n";
			} else {
				echo "Table 'users' created\n";
			}
		}
	}
?>
