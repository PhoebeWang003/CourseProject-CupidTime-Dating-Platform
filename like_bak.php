<?php
// Program Description: This PHP script is part of the CupidTime application, which handles user profile viewing based on the passed user ID ('like_id'). It redirects if the ID is not provided or invalid and displays the user's profile information in a formatted HTML layout.
// author: HO CHAN HOU, Alvin, BC102362
// author: WANG TSZ CHING, Phoebe, BC102628
// author: QU YU MING, Macro, BC103444

include('load.php'); // Include external script for setup or configuration

// Attempt to get the 'like_id' from the query string and default to 0 if it is not set
$likeId = $_GET['like_id'] ?? 0;

// Redirect to the home page if no valid 'like_id' is provided
if (!$likeId) {
    header("Location: home.php");
    exit();
}

// Retrieve user data from the database using the 'like_id'
$likeUser = GetRow('users', ['id' => $likeId]);

// If no user found with the provided 'like_id', alert the user and redirect to home page
if (empty($likeUser)) {
    echo "<script>alert('User does not exist.'); window.location='home.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CupidTime</title>
    <!-- Styling for the user profile page, setting fonts, backgrounds, and responsive container designs -->
    <style>
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
            padding: 20px;
            background-color: #3c55ff; 
            color: white; 
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            margin-left: 20px; 
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
        }
        .container {
            padding: 20px;
            display: flex;
            justify-content: space-between; 
            width: 90%;
            margin: auto;
        }
        .form-container, .photo-container {
            background: rgba(255, 255, 255, 0.85);
            flex: 1;
            margin: 10px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 50%;
            transform: scale(1.1);
            box-sizing: border-box;
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
        input[type="text"], input[type="email"], input[type="number"], input[type="sex"],input[type="pwd"], select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #3c55ff;
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
            margin-bottom: 30px;
        }
        .form-row {
            margin-bottom: 30px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #3c55ff;
            border-radius: 5px;
            box-sizing: border-box;
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
            background-color: #f0f0f0;
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
    </style>
</head>
<body>

<div class="header">
    <div class="title">CupidTime</div>
    <ul class="navigation">
        <li><a href="home.php">Home</a></li>
        <li><a href="blog.php">Blog</a></li>
        <?php
        // Check if the user is logged in and display user-specific links
        if (!empty($user_id)) {
            echo '<a href="#"><i class="fas fa-blog"></i> ' . htmlspecialchars($u['name']) . '</a>';
            echo '<a href="logout.php">logout</a>';
            echo '<a href="profile.php"><i class="fas fa-user-circle"></i> Profile</a>';
        }
        ?>
    </ul>
</div>

<div class="container">
    <div class="form-container">
        <form action="" method="post" id="profileForm" enctype="multipart/form-data">
            <div style="display: flex;width: 100%;justify-content: space-around">
                <div style="width:55%">
                    <h1>User Profile</h1>
                    Email: <input type="email" name="email" value="<?php echo htmlspecialchars($likeUser['email']); ?>" disabled><br>
                    Username: <input type="text" name="name" value="<?php echo htmlspecialchars($likeUser['name']); ?>" disabled><br>
                    Age: <input type="number" name="age" value="<?php echo htmlspecialchars($likeUser['age']); ?>" disabled><br>
                    Sex:  <select name="sex" disabled>
                        <option value="">Select Sex</option>
                        <option value="male" <?php echo $likeUser['sex'] == 'male' ? 'selected' : ''; ?> >Male</option>
                        <option value="female"  <?php echo $likeUser['sex'] == 'female' ? 'selected' : ''; ?>  >Female</option>
                        <option value="other"  <?php echo $likeUser['sex'] == 'other' ? 'selected' : ''; ?>  >Other</option>
                    </select>
                    Height:<input type="number" name="height" value="<?php echo htmlspecialchars($likeUser['height']); ?>" disabled>
                    Region:<input type="text" name="region" value="<?php echo htmlspecialchars($likeUser['region']); ?>" disabled>
                    Introduce: <textarea name="bio" id="" cols="30" rows="10" disabled><?php echo htmlspecialchars($likeUser['bio']); ?></textarea> <br>
                    <input type="hidden" name="edit">
                </div>
                <div class="photo-container" style="width:40%;margin-top: 100px">
                    <div class="user-photo">
                        <img src="<?php echo $likeUser['img']?>" alt="User Photo">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

</body>
</html>
