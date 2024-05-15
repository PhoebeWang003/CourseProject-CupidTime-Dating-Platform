<?php
// Program Description: This PHP script handles user registration with photo upload functionality for a site called "CupidTime". It includes form handling, file upload, and input validation.
// author: HO CHAN HOU, Alvin, BC102362
// author: WANG TSZ CHING, Phoebe, BC102628
// author: QU YU MING, Macro, BC103444

include ('load.php'); // Include necessary PHP files and configurations.

// Main registration condition, checks if the form was submitted and confirmed.
if($_POST && isset($_POST["confirm"])){
    // Collect form data.
    $name = $_POST['name'];
    $sex = $_POST['sex'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $password = $_POST['password']; // User's password. Should be hashed before storing.
    $confirm_password = $_POST['confirm_password']; // Password confirmation field.
    $region = $_POST['region'];
    $height = $_POST['height'];
    $bio = $_POST['bio'];
    $imageData = null;

    // Handle photo upload, if a file was submitted.
    if (isset($_FILES['photo']) && !empty($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
        $imageData = up_file('photo'); // Function to upload file and return file path or data.
    }

    // Check password confirmation.
    if($confirm_password != $password){
        echo "<script>alert('Passwords do not match!'); window.location='signup_page.php';</script>";
        exit();
    }

    // Check if the email is already registered.
    $row = GetRow('users',['email'=> $email]);
    if($row){
        echo "<script>alert('Email already exists!'); window.location='signup_page.php';</script>";
        exit();
    }

    // Prepare data for database insertion.
    $data['name'] = $name;
    $data['sex'] = $sex;
    $data['age'] = $age;
    $data['email'] = $email;
    $data['region'] = $region;
    $data['height'] = $height;
    $data['bio'] = $bio;
    $data['salt'] = rand(1000,9999); // Random salt for password hashing.
    $data['password'] = pwd($password, $data['salt']); // Function to hash password with salt.
    $data['created_at'] = date('Y-m-d H:i:s'); // Timestamp of user creation.
    $data['img'] = $imageData; // Path or data of the uploaded image.

    // Insert the new user data into the database.
    $a = Into('users',$data);
    $row = GetRow('users',['email'=> $email]); // Retrieve newly created user row.
    $_SESSION['user_id'] = $row['id']; // Set user session ID.
    $_SESSION['user'] = $row; // Set user session data.
    if($imageData == null){
        echo "<script>alert('New accound added to database successfully. You can upload your photo later in your profile page!'); window.location='login_page.php';</script>";
    }else{
        echo "<script>alert('New account with photo added to database successfully.'); window.location='login_page.php';</script>";
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Welcome to CupidTime</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        /* Style definitions for the signup page, setting fonts, backgrounds, and form appearance. */
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background: #fce4de;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .signup-container {
            background: rgba(255, 255, 255, 0.85);
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 100%;
            transform: scale(1.1);
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .signup-title {
            font-size: 2.4em;
            color: #3c55ff;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .signup-form {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            column-gap: 20px;
        }
        .form-section {
            display: flex;
            flex-direction: column;
        }
        input, select, textarea, button {
            padding: 10px;
            margin-bottom: 10px;
            border: 2px solid #3c55ff;
            border-radius: 4px;
            font-size: 1rem;
        }
        input[type="file"] {
            display: none;
        }
        .photo-upload-button {
            display: inline-block;
            width: 50px;
            height: 50px;
            background: url('add-photo-icon.png') no-repeat center center;
            background-size: contain;
            cursor: pointer;
        }
        button {
            background-color: #3c55ff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            font-size: 1rem;
        }
        button:hover {
            background-color: #2a3fab;
        }
        .error-message {
            color: red;
            font-size: 0.9rem;
            height: 1rem;
        }
        textarea {
            height: 100px; /* Provides sufficient space for user biography input. */
        }
        
    </style>
</head>
<body>
    <div class="signup-container">
        <div class="signup-title">Sign Up</div>
        <form class="signup-form" method="post" enctype="multipart/form-data">
            <div class="form-section">
                <input type="text" name="name" placeholder="Name" required>
                <select name="sex" required>
                    <option value="">Select Sex</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
                <input type="number" name="age" placeholder="Age" required>
                <textarea name="bio" placeholder="Introduce yourself..."></textarea>
                <input type="hidden" name="action" value="register">
            </div>
            <div class="form-section">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                <input type="text" name="height" placeholder="Height -cm (optional)">
                <input type="text" name="region" placeholder="Region (optional)">
            </div>
            <div class="photo-upload-container">
                <label for="photo" class="photo-upload-button">
                    <img src="upload-icon1.png" alt="Upload Photo" style="width: 250px; height: 150px;">
                </label>
                <input type="file" name="photo" id="photo" accept="image/*">
            </div>
            <div class="form-section full-width">
                <button type="submit" name="confirm">Confirm</button>
                <button type="button" onclick="window.location.href='login_page.php'">Cancel</button>
            </div>
            <div class="error-message" id="error-message"></div>
            
        </form>
    </div>

    <script>
        document.querySelector('.signup-form').addEventListener('submit', function(event) {
            var age = document.querySelector('input[name="age"]').value;
            var password = document.querySelector('input[name="password"]').value;
            var confirmPassword = document.querySelector('input[name="confirm_password"]').value;
            var errorMessage = document.getElementById('error-message');

            if (age < 18) {
                alert("Persons under the age of 18 are prohibited from entering this website");
                event.preventDefault();

            } else {
                if (password !== confirmPassword) {
                    alert("Passwords do not match!");
                    event.preventDefault(); // Prevent the form from submitting
                } else {
                    errorMessage.textContent = ''; // Clear the error message
                }
            }
        });
        document.getElementById('photo').onchange = function() {
            if (this.files && this.files.length > 0) {
                // This can be expanded to change the icon or display the file name
                alert("File selected: " + this.files[0].name);
            }
        };
    </script>
</body>
</html>
