<?php
// Includes the necessary PHP file for loading additional scripts or settings.
// author: HO CHAN HOU, Alvin, BC102362
// author: WANG TSZ CHING, Phoebe, BC102628
// author: QU YU MING, Macro, BC103444

include ('load.php');

// Checks if the $user_id is empty, which would mean no user is logged in.
if (empty($user_id)) {
    // Redirects to the login page if no user is logged in.
    header('Location:login_page.php');
    exit();
}

// Retrieves the 'like_id' from the URL parameter, defaulting to 0 if it's not set.
$likeId = $_GET['like_id'] ?? 0;

// Checks if $likeId is a falsy value (e.g., 0, empty, or not set), indicating no valid ID was passed.
if (!$likeId) {
    // Redirects to the home page if no valid like_id is provided.
    header("Location:home.php");
    exit();
}

// Retrieves a row from the 'like' table where 'user_id' and 'like_id' match the provided values.
$likeUser = GetRow('like', ['user_id' => $user_id, 'like_id' => $likeId]);

// Checks if $likeUser is not empty, implying the like already exists for the user.
if (!empty($likeUser)) {
    // Alerts the user that the like has already been added and redirects back to home.
    echo "<script>alert('You have already added.'); window.location='home.php';</script>";
    exit();
}

// Prepares the data to be inserted into the 'like' table.
$insertData = [
    'user_id' => $user_id,       // ID of the user liking an item.
    'like_id' => $likeId,        // ID of the item being liked.
    'created_at' => date('Y-m-d H:i:s'),  // Current date and time.
];

// Inserts the prepared data into the 'like' table.
Into('like', $insertData);

// Alerts the user that the like was successfully added and redirects to home.
echo "<script>alert('Add like successfully.'); window.location='home.php';</script>";

// Ensures the script stops executing after the redirect.
exit();
?>
