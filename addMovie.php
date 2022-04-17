<?php

//Get needed variables from config file
$config = parse_ini_file("config.ini");
$servername = $config['dbHost'];
$username = $config['dbUser'];
$password = $config['dbPass'];

// Initialize and test sql connection
$conn = new mysqli($servername, $username, $password, 'movieTime');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


// Get needed variables for sql query
$sessionUser = $_POST['user'];
$movieID = $_POST['id'];

// Generate SQL query string
$qstring = "INSERT INTO ".$sessionUser." VALUES (".$movieID.");";

//TODO Check if movie is already in table before adding it




// Make SQL query
$result = mysqli_query($conn,$qstring) or die(mysqli_error($conn));

// Tell the user if the movie was added or not
if ($result == 1) {
  echo 'Movie Added Successfully';
}
else {
  echo 'There was an error adding the specified movie';
}
?>