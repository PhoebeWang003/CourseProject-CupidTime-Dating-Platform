<?php
// Program Description: This script is used to handle user logout by deleting the user session and redirecting to the login page.
// author: HO CHAN HOU, Alvin, BC102362
// author: WANG TSZ CHING, Phoebe, BC102628
// author: QU YU MING, Macro, BC103444

include('load.php'); // Include the load.php file that presumably handles dependencies or initial settings.

// Check if the $user_id variable is empty, indicating no user is currently logged in.
if (empty($user_id)) {
    header('Location:login_page.php'); // Redirect to the login page if $user_id is empty.
    exit(); // Terminate the script execution after redirection.
}

// Function Description: Deletes the user record from the 'users' table where the 'id' matches $user_id.
Del('users', ['id' => $user_id]); // Delete the user data using the Del function, passing 'users' as the table and the user's id as the condition.

session_destroy(); // Destroy all data registered to the session, effectively logging out the user.

header("Location:login_page.php"); // Redirect the user to the login page after the logout process.
exit(); // Terminate the script execution after redirection.
?>
