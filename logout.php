<?php
// This program is used to log out a user from the current session and redirect them to the login page.
// author: HO CHAN HOU, Alvin, BC102362
// author: WANG TSZ CHING, Phoebe, BC102628
// author: QU YU MING, Macro, BC103444


// Includes the load.php script to initialize the session and any other settings required.
include ('load.php');

// Destroys the current session to log out the user.
session_destroy();

// Redirects the user to the login page after logging out.
header("Location:login_page.php");

// Ensures the script is terminated after sending the redirection header.
exit();
?>
