<?php
// Includes the necessary setup file to initialize the application environment
// author: HO CHAN HOU, Alvin, BC102362
// author: WANG TSZ CHING, Phoebe, BC102628
// author: QU YU MING, Macro, BC103444

include ('load.php');

// Prepare SQL query to fetch basic user information from the database
$sql = "SELECT name, sex, bio, img FROM users";

// Check if a page number is set in the URL, validate it, and set the page variable
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

// Set the number of records to show per page
$records_per_page = 6;

// Calculate starting point for the records of the current page
$start_from = ($page - 1) * $records_per_page;

// Resets SQL query to fetch all users from the ybc_users table
$sql = "select * from ybc_users";

// Checks if a search keyword is provided and user's subscription is valid
if (!empty($_GET['key'])){
    if (empty($user_id) || $u['is_vip'] == 0 || (strtotime($u['expire_date']) < time())) {
        // Prompt user to subscribe if not a valid VIP or subscription expired
        echo "<script>if (confirm('Please subscribe to the membership to search')) { window.location='sub_vip.php';}</script>";
        goto loop;
    }
    $key = $_GET['key']; // Assigns search keyword to $key
    $sql .= " where email like '%{$key}%' Or name like '%{$key}%'"; // Modifies SQL to include a search condition
}

loop:
// Append sorting and pagination to the SQL query
$sql .= " order by rand() limit {$start_from},{$records_per_page}";

// Execute the SQL query and fetch all results
$result = Query($sql);
$users =  $result->fetchAll();

?>

<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="UTF-8">
<title>CupidTime - Home</title>
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Dancing+Script&display=swap" rel="stylesheet">
<style>
/* Styling for the entire body of the webpage, including font and background color */
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #fce4de;
    color: #3c55ff;
}

/* Styling for the page header, including background color and text styling */
header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #3c55ff;
    color: white;
    padding: 10px 20px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}
h1 {
    font-family: 'Dancing Script', cursive;
}
header a {
    color: white;
    text-decoration: none;
    font-weight: bold;
    display: inline-flex;
    align-items: center;
}
header a i {
    margin-right: 8px;
}
header a:hover {
    text-decoration: underline;
}

/* Styling for the search box */
.search-box {
    display: flex;
    justify-content: center;
    align-items: center;
}
.search-box input[type="text"] {
    padding: 8px;
    margin-right: 10px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
}
.search-box button {
    padding: 8px 15px;
    background-color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
}
.search-box button:hover {
    background-color: #f0f0f0;
}

/* Styling for the user card layout */
.user-card {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    padding: 20px;
    background-color: #fce4de;
}
.card {
    padding: 15px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    text-align: center;
}
.card img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    margin-bottom: 10px;
    display: block;
    margin-left: auto;
    margin-right: auto;
}
.card h3 {
    font-size: 1.4em;
    font-family: 'Merriweather', serif;
    font-weight: 700;
    text-align: center;
}
.card p {
    font-size: 1.0em;
    padding: 2px 0;
}
.card button {
    padding: 12px 18px;
    background-color: #3c55ff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1.1em;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}
.card button i {
    margin-right: 5px;
}
.card button:hover {
    background-color: #2941cc;
}

/* Footer styling */
footer {
    text-align: center;
    padding: 20px;
    background-color: #3c55ff;
}
footer button {
    padding: 10px 20px;
    background-color: white;
    color: black;
    border: 1px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    margin: 5px;
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease;
}
footer button:hover {
    background-color:  #fce4de;
    transform: translateY(-5px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
}

.extra-margin {
    margin-right: 30px; 
}

</style>
</head>
<body>
<header>
    <div><h1>CupidTime</h1></div>
    <div class="search-box">
        <form method="get" action="" >
            <input type="text" name="key" placeholder="Search...(email/name)" value="<?php echo $_GET['key']??'' ?>">
            <button type="submit">Search</button>
        </form>
    </div>
    <!-- Display user navigation links based on login status -->
    <div>
        <a href="#"class="extra-margin"><i class="fas fa-home"></i> Home</a>
        <a href="blog.php"class="extra-margin"><i class="fas fa-blog"></i> Blog</a>
        <?php if(!empty($user_id)) {?>
            <a href="sub_vip.php"class="extra-margin"><i class="fas fa-crown"></i>Vip</a>
            <a href="profile.php"class="extra-margin"><i class="fas fa-user-circle"></i> Profile</a>
            <a href="#"class="extra-margin"><?php echo $u['name']?></a>
            <a href="logout.php" style="margin-left: auto;"><i class="fas fa-sign-out-alt"></i>   Logout</a>
        <?php }else{ ?>
            <a href="login_page.php">login</a>
        <?php } ?>
    </div>
</header>

<main class="user-card">
    <?php foreach ($users as $row) { ?>
    <div class='card'>
        <img src='<?php echo $row['img']?>' alt="User Image">
        <h3><?php echo $row['name']?></h3>
        <p>Gender: <?php echo $row['sex']?></p>
        <p>Bio: <?php echo $row['bio']?></p>
        <p>Email: <?php echo $row['email']?></p>
        <!-- Generate a button for expressing interest, with a link to 'like.php' passing the user's ID -->
        <button onclick="location.href='like.php?like_id=<?php echo $row['id']?>'">
            <i class="fas fa-heart"></i> Interest
        </button>
    </div>
    <?php } ?>
</main>

<footer>
    <!-- Buttons in footer to navigate to different pages or perform actions -->
<button onclick="window.location.href='home.php'">
    <i class="fas fa-redo"></i> Refresh
</button>
<button onclick="window.location.href='my_like.php'">
    <i class="fas fa-heart"></i> Let's see who's interested in me!
</button>
<button onclick="window.location.href='my_interest.php'">
    <i class="fas fa-heart"></i> Let's see who I like
</button>
</footer>
</body>
</html>
