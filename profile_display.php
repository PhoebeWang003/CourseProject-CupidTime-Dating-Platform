<?php
// Program Description:
// This script handles both the retrieval and update of user information based on their session user ID.
// It retrieves user information and allows the user to update their username, email, and age.
// author: HO CHAN HOU, Alvin, BC102362
// author: WANG TSZ CHING, Phoebe, BC102628
// author: QU YU MING, Macro, BC103444


// Ensure user ID is retrieved from session after user login
$userid = $_SESSION['userid'];  // Variable Description: Holds the user ID from the session

// Prepare SQL statement to fetch user data from the database
$sql = "SELECT username, email, age FROM users WHERE id = ?";
$stmt = $conn->prepare($sql); // Prepare the SQL statement for execution
$stmt->bind_param("i", $userid); // Bind the integer parameter 'userid' to the prepared SQL statement
$stmt->execute(); // Execute the prepared statement
$result = $stmt->get_result(); // Retrieve the result of the query

// Check if data exists for the given user ID and retrieve it
if ($row = $result->fetch_assoc()) {
    $username = $row['username']; // Variable Description: Username of the user
    $email = $row['email']; // Variable Description: Email of the user
    $age = $row['age']; // Variable Description: Age of the user
} else {
    echo "No user found."; // Output if no user is found
}
?>

<?php
// Handle POST request to update user data
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['action'] == 'save') {
    include 'db_connection.php'; // Include the database connection file

    // Retrieve updated data from form POST request
    $username = $_POST['username']; // Form variable for username
    $email = $_POST['email']; // Form variable for email
    $age = $_POST['age']; // Form variable for age
    $userid = $_SESSION['userid']; // Variable Description: Session variable for user ID

    // Prepare SQL statement to update user data
    $sql = "UPDATE users SET username=?, email=?, age=? WHERE id=?";
    $stmt = $conn->prepare($sql); // Prepare the SQL statement for execution
    $stmt->bind_param("ssii", $username, $email, $age, $userid); // Bind parameters to the statement
    if ($stmt->execute()) {
        echo "Record updated successfully"; // Success message
    } else {
        echo "Error updating record: " . $conn->error; // Error message
    }
    $stmt->close(); // Close the statement
    $conn->close(); // Close the database connection
}
?>
