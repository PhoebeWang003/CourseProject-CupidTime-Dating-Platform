<?php
// This PHP script fetches and displays user profiles that the current user has liked on a website named "CupidTime".
// author: HO CHAN HOU, Alvin, BC102362
// author: WANG TSZ CHING, Phoebe, BC102628
// author: QU YU MING, Macro, BC103444

include('load.php'); // Includes external script to load necessary configurations or libraries.

// Executes a SQL query to select all entries from 'ybc_like' table where the 'user_id' matches the current user.
$result = Query("select * from ybc_like where user_id = " . $user_id);
$likes = $result->fetchAll(); // Fetches all the results from the query.
$users = []; // Initializes an array to store user profiles.

// Checks if the 'likes' array is not empty.
if (!empty($likes)) {
    $uidArr = array_column($likes, 'like_id'); // Extracts 'like_id' from each entry in the 'likes' array.
    // Constructs a SQL query to fetch user details from 'ybc_users' table for the liked IDs.
    $sql = "select * from ybc_users where id in (" . implode(',', $uidArr) . ")";
    $sql .= " order by rand()"; // Adds a random order clause to the SQL query.
    $result = Query($sql); // Executes the SQL query.
    $users =  $result->fetchAll(); // Fetches all the results from the query.
}
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <title>CupidTime - Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Dancing+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* CSS styles for various HTML elements */
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
            padding: 20px 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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
    <header>
        <div>
            <h1>CupidTime</h1> <!-- Website logo or title -->
        </div>
        <div>
            <a href="home.php"><i class="fas fa-home"></i> Home</a> <!-- Navigation link to home -->
            <a href="blog.php"><i class="fas fa-blog"></i> Blog</a> <!-- Navigation link to blog -->
            <?php if (!empty($user_id)) { ?>
                <a href="sub_vip.php"><i class="fas fa-crown"></i>Vip</a> <!-- Navigation link for VIP subscription -->
                <a href="profile.php"><i class="fas fa-user-circle"></i> Profile</a> <!-- Navigation link to user profile -->
                <a href="#"><?php echo $u['name'] ?></a> <!-- Displays the user's name -->
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> logout</a> <!-- Navigation link for logging out -->
            <?php } else { ?>
                <a href="login_page.php">login</a> <!-- Navigation link for logging in -->
            <?php } ?>
        </div>
    </header>

    <main class="user-card">
        <?php
        // Loops through each user profile and creates a card with their details.
        foreach ($users as $row) { ?>
            <div class='card'>
                <img src='<?php echo $row['img'] ?>'> <!-- Displays user image -->
                <h3><?php echo $row['name'] ?></h3> <!-- Displays user name -->
                <p>Gender:<?php echo $row['sex'] ?></p> <!-- Displays user gender -->
                <p><?php echo $row['bio'] ?></p> <!-- Displays user biography -->
                <p><?php echo $row['email'] ?></p> <!-- Displays user email -->
                <button onclick="cancelLike(<?php echo $row['id']; ?>)"> Cancel </button>
                <script>
                    function cancelLike(userId) {
                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', 'cancel_like.php', true);
                        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                alert('Cancel Successfully!!');
                                location.reload(); 
                            }
                        };
                        xhr.send('userId=' + userId);
                    }
                </script>
            </div>
        <?php } ?>
    </main>


</body>

</html>