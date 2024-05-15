<?php
/**
 * Program Description:
 * This PHP script is part of a web application named CupidTime. It handles user authentication
 * and redirects unauthenticated users to the login page. The program integrates HTML and PHP
 * to render a membership subscription page with dynamic content based on user authentication status.
 */
// author: HO CHAN HOU, Alvin, BC102362
// author: WANG TSZ CHING, Phoebe, BC102628
// author: QU YU MING, Macro, BC103444


/**
 * Includes the necessary dependencies and initializes the session or environment settings.
 */
include('load.php');

/**
 * Variable Description:
 * $user_id - Represents the unique identifier for the currently logged-in user.
 * If this variable is empty, it indicates that no user is currently authenticated.
 */
if (empty($user_id)) {
    /**
     * Function Description:
     * header() - Sends a raw HTTP header to the client. Used here to redirect the user
     * to the login page if they are not logged in.
     * 
     * Statement Description:
     * Redirects the user to 'login_page.php' if they are not authenticated and then terminates the script.
     */
    header('Location:login_page.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    // External resources for styles and fonts
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Dancing+Script&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <title>CupidTime</title>
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
            padding: 25px 45px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
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
            margin-right: 30px;
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
            padding: 20px;
            width: 80%;
            margin: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .content{
            display: flex;
            justify-content: center;
            flex-direction: row;
            width: 120%;
        }
        .content div:nth-child(2){
            margin-left: 150px;
        }

        .signup-container {
            background: rgba(255, 255, 255, 0.85);
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 30%;
            transform: scale(1.1);
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 200px;
        }
        .signup-container h3 {
            margin-top: 1em;
            margin-bottom: 1em;
        }
        .signup-container ul {
            list-style-type: disc;
            padding-left: 20px;
            margin-left: 0;
            margin-top: 0;
            margin-bottom: 0;
        }
        .signup-container ul li {
            font-size: 1.17em;
            line-height: 1.6;
        }

        button {
            padding: 10px;
            margin-bottom: 10px;
            border: 2px solid #3c55ff;
            border-radius: 4px;
            font-size: 1rem;
            background-color: #3c55ff;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: 500;
        }
        button:hover {
            background-color: #2a3fab;
        }
        .extra-margin {
            margin-right: 30px;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="title">CupidTime</div>
    <ul class="navigation">
        <li><a href="home.php"><i class="fas fa-home"></i>Home</a></li>
        <li><a href="blog.php"><i class="fas fa-blog"></i>Blog</a></li>
        <?php if(!empty($user_id)) {?>
            <a href="sub_vip.php" class="extra-margin"><i class="fas fa-crown"></i>Vip</a>
            <a href="profile.php"class="extra-margin"><i class="fas fa-user-circle"></i>Profile</a>
            <a href="#"class="extra-margin"> <?php echo $u['name'] ?></a>
            <a href="logout.php" style="margin-left: auto;"><i class="fas fa-sign-out-alt"></i>logout</a>
        <?php }else{ ?>
            <a href="login_page.php">login</a>
        <?php } ?>
    </ul>
</div>

<div class="container">
    <h1>Subscribe Our Membership!</h1>
    <div class="content">
        <div class="signup-container">
            <h2>Free Plan</h2>
            <h3>You can only use some basic functions in our Free Plan</h3>
            <ul>
                <li>Modify your profile</li>
                <li>View profiles and photos</li>
                <li>Like Someone you are interested in!</li>
            </ul>
        </div>
        <div class="signup-container">
            <h2>Membership program</h2>
            <h3>Access more functions in our Cupid-Time Membership!</h3>
            <ul>
                <li>Use all functions in our Free Plan</li>
                <li>Search for specific person you like!</li>
            </ul>
            <?php
            /**
             * Conditional rendering based on the user's VIP status:
             * Displays a subscribe button if the user is not a VIP or their VIP status has expired.
             * Uses PHP to check the conditions and render the appropriate HTML.
             */
            if($u['is_vip'] == 0 || (strtotime($u['expire_date']) < time()) ) {?>
                <button type="button" onclick="location.href='vip.php'" name="confirm">Subscribe Membership</button>
            <?php }else {?>
                <button type="button" disabled name="confirm">Already Joined!</button>
            <?php } ?>
        </div>
    </div>
</div>
</body>
</html>