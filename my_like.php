<?php
// Program Description: This PHP script is part of the CupidTime website, which displays user profiles based on their likes. It fetches user data from a database and presents it in a web page.
// author: HO CHAN HOU, Alvin, BC102362
// author: WANG TSZ CHING, Phoebe, BC102628
// author: QU YU MING, Macro, BC103444

include ('load.php'); // Include the necessary setup file.

// Function Description: Executes a database query to fetch likes based on the current user ID.
$result = Query("select * from ybc_like where like_id = ".$user_id);
$likes = $result->fetchAll(); // Fetches all results into an array.

$users = []; // Initializes an array to store user data.

// Statement Description: Checks if the likes array is not empty.
if (!empty($likes)){
    // Variable Description: Extracts 'user_id' columns from the likes array.
    $uidArr = array_column($likes, 'user_id');

    // Function Description: Constructs a SQL query to fetch user details from the 'ybc_users' table based on user IDs.
    $sql = "select * from ybc_users where id in (".implode(',', $uidArr).")";
    $sql .= " order by rand()"; // Adds random order to the query.
    $result = Query($sql); // Executes the SQL query.
    $users = $result->fetchAll(); // Fetches all user data into an array.
}
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>CupidTime - Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Dancing+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #fce4de;
            color: #3c55ff;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #3c55ff;
            color: white;
            padding: 10px 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .title {
            font-size: 18px;
            font-weight: bold;
            margin-left: 20px;
            font-family: 'Dancing Script', cursive;
        }

        .search-box input[type="text"] {
            padding: 8px;
            border: none;
            border-radius: 4px;
            width: 200px;
        }

        header a {
            color: white;
            text-decoration: none;
            margin-left: 10px;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
        }

        header a i {
            margin-right: 5px;
        }

        header a:hover {
            text-decoration: underline;
        }

        .user-card {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            padding: 20px;
            background-color: #fce4de;
        }

        .card {
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        .card h3 {
            font-size: 1.4em;
            font-family: 'Merriweather', serif;
            font-weight: 700;
            text-align: center;
        }

        .card img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .card button {
            padding: 10px 15px;
            background-color: #3c55ff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .card button:hover {
            background-color: #2941cc;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #e6f89c;
        }

        footer button {
            padding: 10px 20px;
            background-color: #3c55ff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        footer button:hover {
            background-color: #2941cc;
        }
    </style>
</head>
<body>
<!-- Header Section: Contains the navigation bar and site branding -->
<header>
    <!-- Site Title: Displays the website's name with a custom font style -->
    <div class="title"><h1>CupidTime</h1></div>
    <!-- Navigation Links: Provides links to other pages and functionalities based on the user's session status -->
    <div>
        <a href="home.php"><i class="fas fa-home"></i> Home</a> <!-- Home link -->
        <a href="blog.php"><i class="fas fa-blog"></i> Blog</a> <!-- Blog link -->
        <?php if (!empty($user_id)) { ?>
            <a href="sub_vip.php"><i class="fas fa-crown"></i> Vip</a> <!-- VIP link, only visible if user is logged in -->
            <a href="profile.php"><i class="fas fa-user-circle"></i> Profile</a> <!-- Profile link, only visible if user is logged in -->
            <a href="#"><php echo $u['name'] ?></a> <!-- Displays the logged-in user's name -->
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a> <!-- Logout link -->
        <?php } else { ?>
            <a href="login_page.php">Login</a> <!-- Login link, only visible if user is not logged in -->
        <?php } ?>
    </div>
</header>

<!-- Main Content: Displays user profiles in a card layout -->
<main class="user-card">
    <!-- Loop through each user and create a card with their information -->
    <?php foreach ($users as $row) { ?>
        <div class='card'>
            <img src='<?php echo $row['img']?>' > <!-- User's profile image -->
            <h3><?php echo $row['name']?></h3> <!-- User's name -->
            <p>Gender:<?php echo $row['sex']?></p> <!-- User's gender -->
            <p><?php echo $row['bio']?></p> <!-- User's biography -->
            <p><?php echo $row['email']?></p> <!-- User's email -->
        </div>
    <?php } ?>
</main>

</body>
</html>
