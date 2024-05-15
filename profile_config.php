<?php
// Program Description: This script establishes a connection to a MySQL database using the mysqli extension.
// It includes configurations for the database connection and error handling if the connection fails.
// author: HO CHAN HOU, Alvin, BC102362
// author: WANG TSZ CHING, Phoebe, BC102628
// author: QU YU MING, Macro, BC103444


// Variable Description: $servername - the hostname of the database server, usually "localhost"
$servername = "localhost";
// Variable Description: $username - the username used to access the database
$username = "your_username";
// Variable Description: $password - the password associated with the username for database access
$password = "your_password";
// Variable Description: $dbname - the name of the database to connect to
$dbname = "your_dbname";

// Function Description: mysqli constructor - tries to establish a new connection to the MySQL database server
// Statement Description: Creates a new mysqli object named $conn
$conn = new mysqli($servername, $username, $password, $dbname);

// Statement Description: Checks if the connection was not successful
if ($conn->connect_error) {
    // Function Description: die() - terminates the script
    // Statement Description: If connection fails, the script will terminate and show the error message
    die("Connection failed: " . $conn->connect_error);
}
?>
