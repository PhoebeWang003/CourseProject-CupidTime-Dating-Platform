<?php
// This PHP script handles user login verification for a dating site named "CupidTime".
// author: HO CHAN HOU, Alvin, BC102362
// author: WANG TSZ CHING, Phoebe, BC102628
// author: QU YU MING, Macro, BC103444


include ('load.php'); // Includes the load.php file, which sets up the environment and defines necessary functions.

// Checks if a POST request has been made and if it includes the 'login' field.
if ($_POST && isset($_POST['login'])) {
    // Fetches user data based on the submitted email. The GetRow function is presumably defined in 'load.php'.
    $u = GetRow('users', ['email' => $_POST['email']]);
    if ($u) { // Checks if the user exists in the database.
        // Generates a hashed password using the submitted password and the user's salt, function likely defined in 'load.php'.
        $pwd = pwd($_POST['password'], $u['salt']);
        if ($pwd == $u['password']) { // Compares the generated hash with the stored hash to verify the password.
            // Sets session variables to log the user in and store their user data.
            $_SESSION['user_id'] = $u['id'];
            $_SESSION['user'] = $u;
            // Sends a success message and redirects the user to the home page.
            echo "<script>alert('login success!'); window.location='home.php';</script>";
            exit(); // Exits the script to prevent further execution.
        }
    }
    // Sends an error message and redirects back to the login page if the password is incorrect.
    echo "<script>alert('Passwords do not match! Forget your password? Please email to bc10236@um.edu.mo'); window.location='login_page.php';</script>";
    exit(); // Exits the script.
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"> <!-- Sets the character encoding for the HTML document -->
<meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Ensures the page is responsive on all devices -->
<link href="https://fonts.googleapis.com/css?family=Fugaz+One&display=swap" rel="stylesheet"> <!-- Imports Fugaz One font for stylish headings -->
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Roboto:wght@400&display=swap" rel="stylesheet"> <!-- Imports Dancing Script and Roboto fonts for varied text styling -->

<title>Login Page</title> <!-- Sets the title of the web page displayed in the browser tab -->
<style>
    body, html {
        margin: 0; padding: 0; height: 100%; /* Resets margin and padding, and sets height to 100% of the viewport */
        font-family: 'Fugaz One', sans-serif; /* Sets the default font for the body */
        background-color: #FFF2A6; /* Sets a light yellow background color */
    }

    .container {
        display: flex; width: 100%; height: 100vh; overflow: hidden; /* Styles the container to fill the entire viewport */
    }

    .banner {
        flex: 1; background-size: cover; animation: bannerChange 16s infinite; /* Styles the banner with a changing background image */
    }

    .login-form {
        flex: 1; display: flex; justify-content: center; align-items: center; /* Centers the login form horizontally and vertically */
    }

    .form-container {
        background: rgba(255, 255, 255, 0.5); /* Semi-transparent white background for the form container */
        width: 80%; max-width: 320px; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); /* Styling for the form container */
    }

    form {
        display: flex; flex-direction: column; /* Sets up the form elements to display in a column */
    }

    input, button {
        padding: 15px; margin: 10px 0; border-radius: 8px; border: 1px solid transparent; transition: all 0.3s ease-in-out; /* Uniform styling for all input fields and buttons */
    }

    input:focus, button:focus {
        border-color: #6a74fc; outline: none; /* Highlights inputs and buttons when focused */
    }

    button {
        background-image: linear-gradient(45deg, #6a74fc, #88a2fc); color: white; border: none; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); /* Stylish gradient buttons */
    }

    button:hover {
        background-image: linear-gradient(45deg, #5c67f2, #7a8ffc); /* Changes button background on hover */
    }

    @keyframes bannerChange {
        0%, 25% { background-image: url('loginpic1.png'); }
        26%, 50% { background-image: url('loginpic4.png'); }
        51%, 75% { background-image: url('loginpic3.png'); }
        76%, 100% { background-image: url('loginpic2.png'); } /* Keyframes for banner background animation */
    }

    .banner-text {
        position: absolute; top: 20px; left: 20px; color: white; font-size: 90px; font-weight: lighter; padding: 10px; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); /* Styling for banner text */
    }

    .cupid-time {
        font-family: 'Dancing Script', cursive; font-size: 48px; position:absolute; top: 1px; left: 50px; color: #3c55ff; text-shadow: 1px 1px 3px rgba(0,0,0,0.7); /* Additional decorative text in the banner */
    }
</style>
</head>
<body>
    <div class="container">
        <div class="banner">
            <p class="cupid-time">CupidTime</p> <!-- Displays the site name in a stylized font -->
            <p class="banner-text">DATING FOR EVERY<br> SINGLE PERSON</p> <!-- Displays a welcoming message in the banner -->
        </div>
        <div class="login-form">
            <div class="form-container">
                <form action="#" method="POST">
                    <input type="email" id="email" name="email" placeholder="Email" required> <!-- Input for email -->
                    <input type="password" id="password" name="password" placeholder="Password" required> <!-- Input for password -->
                    <input type="hidden" name="login" value="login"> <!-- Hidden input to identify login action -->
                    <button type="submit">Login</button> <!-- Button to submit the form -->
                    <p style="font-family: 'Roboto', sans-serif;">Don't have an account?</p> <!-- Text prompting to sign up if no account -->
                    <button type="button" onclick="window.location='signup_page.php';">Sign Up</button> <!-- Button to navigate to signup page -->
                </form>
            </div>
        </div>
    </div>
    <script>
        document.body.style.transition = "background-color 1s"; // Adds a transition effect for background color changes
        let colors = ["#F8BBD0", "#C8E6C9", "#BBDEFB", "#FFCDD2"]; // Array of colors for background cycling
        let currentIndex = 0; // Index to keep track of the current color

        // Function to cycle through background colors every 4 seconds
        function changeBackgroundColor() {
            document.body.style.backgroundColor = colors[currentIndex]; // Changes the background color
            currentIndex = (currentIndex + 1) % colors.length; // Updates index to cycle through colors
        }

        setInterval(changeBackgroundColor, 4000); // Sets interval to change background color periodically

    </script>
</body>
</html>
