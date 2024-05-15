<?php
// This PHP script handles VIP membership subscription, including input validation and database updates.
// author: HO CHAN HOU, Alvin, BC102362
// author: WANG TSZ CHING, Phoebe, BC102628
// author: QU YU MING, Macro, BC103444

include('load.php'); // Load required resources and initialize the environment.

// Redirect to login page if user is not logged in.
if (empty($user_id)) {
    header('Location:login_page.php');
    exit();
}

// Handle POST request when subscription form is submitted.
if ($_POST && isset($_POST["subscription"])) {
    // Validate mandatory fields: credit number, name, and CVV.
    if (empty($_POST['credit_number']) || empty($_POST['name']) || empty($_POST['cvv'])) {
        echo "<script> window.location='vip.php';</script>";
        exit();
    }

    // Prepare data for database insertion.
    $insertData = [
        'credit_number' => $_POST['credit_number'], // User's credit card number.
        'name' => $_POST['name'], // User's name.
        'cvv' => $_POST['cvv'], // Card CVV.
        'created_at' => date('Y-m-d H:i:s'), // Current timestamp.
        'user_id' => $user_id, // User ID from session.
        'email' => $u['email'], // User email from session.
    ];
    $id = Into('vip', $insertData, true); // Insert into 'vip' table and return new record ID.

    // Calculate membership expiration date.
    $expireDate = date('Y-m-d', time() + 31 * 24 * 3600); // Set expiration date to 31 days from now.
    edit('users', ['id' => $u['id']], ['is_vip' => 1, 'expire_date' => $expireDate]); // Update user status to VIP.

    // Prepare and send VIP success email.
    $content = "<h2 style='text-decoration: underline'>Congratulations, successfully subscribed membership</h2>
<div>Order Id: #{$id}</div>
<div>Order time:" . date('Y-m-d H:i:s') . "</div><br><br>
<div>Subscribe Member:{$u['name']}</div>
<div>Subscribe Date:" . date('Y-m-d') . "</div>
<div>Expire Date:{$expireDate}</div><br>
<div>If you have other question about your order,please feel free to email us!</div>";
    sendEmail($u['email'], 'vip success', $content);
    echo "<script>alert('account with vip insert to database successfully.'); window.location='home.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Dancing+Script&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <title>CupidTime</title>
    <style>
        /* Styling for the overall page, including font, margins, backgrounds, and component specific styles like navigation, headers, and forms. */
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
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #3c55ff;
            /* Adjusted to blue background */
            color: white;
            /* Text color white for better contrast */
        }

        .title {
            font-size: 32px;
            font-weight: bold;
            margin-left: 20px;
            /* Add some spacing from the edge */
            font-family: 'Dancing Script', cursive;
        }

        .navigation {
            list-style-type: none;
            margin: 0;
            /* Remove default margin */
            padding: 0;
            /* Remove default padding */
        }

        .navigation li {
            display: inline;
            margin-right: 20px;
            /* Adjusted spacing for navigation items */
        }

        .navigation a {
            text-decoration: none;
            color: white;
            /* Make links white */
            font-weight: bold;
            /* Make text bold */
        }

        .navigation a:hover {
            border-color: #3c55ff;
            text-decoration: underline;
        }

        .container {
            padding: 20px;
            display: flex;
            justify-content: space-between;
            /* This will space out the child elements */
            width: 90%;
            margin: auto;
        }

        .form-container,
        .photo-container {
            background: rgba(255, 255, 255, 0.85);
            flex: 1;
            /* Each container will take equal amount of space */
            margin: 10px;
            /* Optional, for some space between the two */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 50%;
            transform: scale(1.1);
            box-sizing: border-box;
        }

        /* You can adjust this if you need the form or photo container to be wider or narrower */
        .form-container {
            max-width: 100%;
            /* Adjusted for demonstration */
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

        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="sex"],
        input[type="pwd"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 2.5px solid #3c55ff;
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
            /* Set a fixed width for the photo */
            height: 300px;
            /* Set a fixed height for the photo */
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .user-photo img {
            max-width: 100%;
            max-height: 100%;
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
            color: #3c55ff;
            font-weight: bold;
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
            border: 2.5px solid #3c55ff;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-footer {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 3px;
            background-color: #f0f0f0;
            margin-top: 10px;
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

        .transparent-box {
            background: rgba(255, 255, 255, 0.6);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2 {
            color: #3c55ff;
        }
    </style>
</head>

<body>

    <!-- Header section contains the logo and navigation bar -->
    <div class="header">
        <div class="title">CupidTime</div>
        <ul class="navigation"><!-- Navigation menu for the website -->
            <li><a href="home.php"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="blog.php"><i class="fas fa-blog"></i>Blog</a></li>
            <?php if (!empty($user_id)) { ?><!-- Conditional rendering based on user login status -->
                <a href="sub_vip.php" class="extra-margin"><i class="fas fa-crown"></i>Vip</a><!-- VIP subscription link, visible only to logged-in users -->
                <a href="profile.php" class="extra-margin"><i class="fas fa-user-circle"></i> Profile</a>
                <a href="#" class="extra-margin"><?php echo $u['name'] ?></a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i>logout</a>

            <?php } else { ?>
                <a href="login_page.php">login</a><!-- Login link, visible only to non-logged-in users -->
            <?php } ?>
        </ul>
    </div>

    <!-- Main content container -->
    <div class="container">
        <div class="transparent-box"><!-- A semi-transparent box that wraps the content -->
            <h2>Subscription member</h2>
            <form action="" method="post" id="profileForm" enctype="multipart/form-data"> <!-- Form for subscription details -->
                <div class="form-group">
                    Credit card number: <input type="text" id="creditCardNumber" name="credit_number" value=""><br>
                    Name: <input type="text" id="name" name="name" value=''><br>
                    CVV: <input type="text" id="cvv" name="cvv" value=""><br>
                    <input type="hidden" name="subscription"> <!-- Hidden input to identify the form's purpose -->
                </div>

                <div class="form-footer">
                    <button type="button" name="action" value="save" onclick="validateForm()">Save</button><!-- Submit button with inline validation -->
                </div>
        </div>
        </form>
    </div>

    </div>
    <script>
        function validateForm() {
            // Variable declarations for form inputs
            var creditCardNumber = document.getElementById('creditCardNumber').value;
            var name = document.getElementById('name').value;
            var cvv = document.getElementById('cvv').value;

            // Validation for credit card numbers
            if (/^\d{16}$/.test(creditCardNumber)) {
                // Validation for holder name
                if (/^[a-zA-Z\s]+$/.test(name)) {
                    // Validation for CVV
                    if (/^\d{3}$/.test(cvv)) {

                        // Allow form submission if all checks pass
                        var form = document.getElementById("profileForm");
                        form.submit();
                        alert("Form submitted successfully!");
                    } else {
                        alert("CVV should not be empty and must be 3 digits!!");

                    }
                } else {
                    alert("Name should not be empty and must contain only letters!");

                }

            } else {
                alert("Credit card number should not be empty and must be 16 digits!!");

            }






        }
    </script>


</body>