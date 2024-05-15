<?php
// Program Description: This script processes the profile update in a user management system, handling form submission for profile updates including image uploads.
// author: HO CHAN HOU, Alvin, BC102362
// author: WANG TSZ CHING, Phoebe, BC102628
// author: QU YU MING, Macro, BC103444

include('load.php'); // Include necessary dependencies and session start

// Redirect to login page if user is not logged in
if (empty($user_id)) {
    header('Location:login_page.php');
    exit();
}

// Check if form is submitted and the edit flag is set
if ($_POST && isset($_POST["edit"])) {
    // Retrieve user input from form
    $sex = $_POST['sex'];
    $age = $_POST['age'];
    $password = $_POST['password']; // User's password input (to be hashed)
    $height = $_POST['height'];
    $region = $_POST['region'];
    $bio = $_POST['bio'];
    $name = $_POST['name'];

    // Hash the password if not empty
    if (!empty($password)) {
        $password = pwd($password, $u['salt']); // Hashing function
    }

    // Handle file upload for user photo
    if (isset($_FILES['photo']) && !empty($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
        $imageData = up_file('photo'); // File upload function
    }

    // Prepare data array for updating user information
    $updateData = [
        'sex' => $sex,
        'age' => $age,
        'height' => $height,
        'region' => $region,
        'bio' => $bio,
        'name' => $name,
    ];

    // Add hashed password to the update data array if it exists
    if (!empty($password)) {
        $updateData['password'] = $password;
    }

    // Add image data to the update array if photo upload was successful
    if (!empty($imageData)) {
        $updateData['img'] = $imageData;
    }

    // Call function to update user information in the database
    edit('users', ['id' => $u['id']], $updateData);

    // Alert the user and redirect to profile page
    echo "<script>alert('Account with photo updated to database successfully.'); window.location='profile.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- HTML Head Section with links to stylesheets and meta information -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Dancing+Script&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <title>CupidTime</title>
    <style>
        /* CSS Styles for HTML elements */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #fce4de;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 25px 45px;
            background-color: #3c55ff;
            color: white;
        }
        .title {
            font-size: 32px;
            font-weight: bold;
            margin-left: 20px;
            font-family: 'Dancing Script', cursive;
        }
        .navigation {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        .navigation li {
            display: inline;
            margin-right: 20px;
        }
        .navigation a {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }
        .navigation a:hover {
            border-color: #3c55ff;
            text-decoration: underline;
        }
        .container {
            padding: 60px;
            display: flex;
            justify-content: space-between;
            width: 90%;
            margin: auto;
        }
        .form-container, .photo-container {
            flex: 1;
            margin: 10px;
            padding: 20px;
            border-radius: 5px;
            max-width: 600px;
            width: 50%;
            transform: scale(1.1);
        }
        .form-container {
            max-width: 100%;
        }
        .photo-container {
            flex: 0.5;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            height: 100%;
        }
                /* Styling for all input types including text, email, number, select, textarea, and password to ensure consistent appearance across the form */
                input[type="text"], input[type="email"], input[type="number"], select, textarea, input[type="password"] {
            width: calc(100% - 120px);
            padding: 10px;
            border:2.5px solid #3c55ff;
            border-radius: 5px;
            box-sizing: border-box;
        }
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            color: white;
            background-color: #0000ff;
            cursor: pointer;
        }
        button:hover {
            background-color: #0000cc;
        }
        .user-photo {
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }
        .user-photo img {
            width: 100%;
            border-radius: 10px;
        }
        .upload-btn-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }
        .btn {
            border: 2px solid #3c55ff;
            color: #3c55ff;
            background-color: white;
            padding: 8px 20px;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
        }
        .upload-btn-wrapper input[type=file] {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
        }
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            width: 100%;
        }
        .form-group label {
            width: 100px; /* Fixed label width for consistent styling */
            margin-right: 20px;
            color:#3c55ff;
            font-weight: bold;
        }
        .form-footer {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            position: fixed;
            bottom: 0;
            left: 0;
            padding: 10px;
        }
        .form-footer button:hover {
            background-color: #E18787;
        }
        .form-footer button {
            padding: 8px 15px;
            margin: 0 10px;
            font-size: 16px;
            background-color: #3c55ff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .extra-margin {
            margin-right: 30px;
        }
        h1 {
            color: #3c55ff; /* Sets the color of h1 titles */
        }
    </style>
</head>
<body>
<div class="header">
    <div class="title">CupidTime</div>
    <ul class="navigation">
        <li><a href="home.php"><i class="fas fa-home"></i>Home</a></li>
        <li><a href="blog.php"><i class="fas fa-blog"></i>Blog</a></li>
        <?php
        // Display additional navigation items if user is logged in
        if (!empty($user_id)) { ?>
            <a href="sub_vip.php" class="extra-margin"><i class="fas fa-crown"></i>Vip</a>
            <a href="profile.php" class="extra-margin"><i class="fas fa-user-circle"></i> Profile</a>
            <a href="#" class="extra-margin"><?php echo $u['name'] ?></a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
        <?php } else { ?>
            <a href="login_page.php">Login</a>
        <?php } ?>
    </ul>
</div>
<div class="container">
    <div class="form-container">
        <form action="" method="post" id="profileForm" enctype="multipart/form-data">
            <div style="display: flex; width: 100%; justify-content: space-around">
                <div style="width:55%">
                    <h1>User Profile</h1>
                    <div class="form-group">
                        <label>Email:</label><input type="email" name="email" value="<?php echo htmlspecialchars($u['email']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Username:</label><input type="text" name="name" value="<?php echo htmlspecialchars($u['name']); ?>">
                    </div>
                    <div class="form-group">
                        <label>Age:</label><input type="number" name="age" value="<?php echo htmlspecialchars($u['age']); ?>">
                    </div>
                    <div class="form-group">
                        <label>Sex:</label>
                        <select name="sex">
                            <option value="">Select Sex</option>
                            <option value="male" <?php echo $u['sex'] == 'male' ? 'selected' : '' ?>>Male</option>
                            <option value="female" <?php echo $u['sex'] == 'female' ? 'selected' : '' ?>>Female</option>
                            <option value="other" <?php echo $u['sex'] == 'other' ? 'selected' : '' ?>>Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Password:</label><input type="password" name="password">
                    </div>
                    <div class="form-group">
                        <label>Height:</label><input type="number" name="height" value="<?php echo htmlspecialchars($u['height']); ?>">
                    </div>
                    <div class="form-group">
                        <label>Region:</label><input type of="text" name="region" value="<?php echo htmlspecialchars($u['region']); ?>">
                    </div>
                    <div class="form-group">
                        <label>Introduction:</label><textarea name="bio" cols="30" rows="10"><?php echo htmlspecialchars($u['bio']); ?></textarea>
                    </div>
                    <input type="hidden" name="edit">
                </div>
                <div class="photo-container" style="width:40%; margin-top: 100px">
                    <div class="user-photo">
                        <img src="<?php echo $u['img'] ?>" alt="User Photo">
                    </div>
                    <div class="upload-btn-wrapper">
                        <button class="btn">Upload a photo</button>
                        <input type="file" name="photo">
                    </div>
                </div>
            </div>
            <div class="form-footer" style="bottom: -100px">
                <button type="submit" name="action" value="save">Save</button>
                <button type="button" name="action1" value="cancelAccount" onclick="location.href='cancel_account.php'">Cancel Account</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
