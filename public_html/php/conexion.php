<?php
	$servername = "localhost";
	$username = "nviameco";
	$password = "RB1fr30a";
	$dbname = "nviameco_db";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
		die("Fallo en la conexión: " . $conn->connect_error);
	} 
?>