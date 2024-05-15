<?php
// Program Description: This PHP script is designed to handle search queries for a blog section of a website, 
// displaying news articles that match the search criteria or listing all articles if no search term is provided.
// author: HO CHAN HOU, Alvin, BC102362
// author: WANG TSZ CHING, Phoebe, BC102628
// author: QU YU MING, Macro, BC103444

include('load.php'); // Include necessary functions and database connection setup.

// Check if there is a search term in the query string, sanitize it to prevent XSS attacks.
$search_query = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';

// Construct an SQL query based on whether a search term is present. If present, filter news by title; otherwise, select all news.
$sql = $search_query ? "SELECT * FROM ybc_news WHERE title LIKE '%$search_query%' ORDER BY RAND()" : "SELECT * FROM ybc_news ORDER BY RAND()";
$result = Query($sql); // Execute the query using a predefined function `Query`.

$content = []; // Initialize an empty array to store the news articles.
if ($result){
    $content = $result->fetchAll(); // Fetch all results into the array if the query was successful.
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Set the character encoding for the document -->
    <title>Dancing Script Example</title> <!-- Set the title of the HTML document -->
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet"> <!-- Include a specific Google font for styling -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Include Font Awesome for icons -->
    <style>
        body {
            font-family: Arial, sans-serif; /* Set the default font for the body */
            margin: 0; padding: 0; /* Remove default margin and padding */
            background: #fce4de; /* Set a light peach background color */
        }
        .header {
            display: flex; /* Use flexbox for layout */
            justify-content: space-between; /* Space elements evenly */
            align-items: center; /* Align elements vertically */
            padding: 20px; /* Add padding inside the header */
            background-color: #3c55ff; /* Set a blue background color */
            color: white; /* Set text color to white */
        }
        .title {
            font-family: 'Dancing Script', cursive; /* Stylish font for the title */
            font-size: 32px; /* Larger font size for visibility */
            font-weight: bold; /* Bold font weight */
            margin-left: 20px; /* Margin on the left for spacing */
        }
        .search-box {
            display: flex; /* Use flexbox for the search box layout */
            justify-content: center; /* Center items horizontally */
            align-items: center; /* Align items vertically */
        }
        .search-form input[type="text"] {
            padding: 8px; /* Padding inside the text input */
            margin-right: 10px; /* Margin on the right for spacing */
            font-size: 16px; /* Set font size */
            border: none; /* Remove border */
            border-radius: 5px; /* Rounded corners for the text input */
        }
        .search-form button {
            padding: 8px 15px; /* Padding inside the button */
            background-color: #fff; /* White background for the button */
            border: none; /* Remove border */
            border-radius: 5px; /* Rounded corners for the button */
            cursor: pointer; /* Pointer cursor on hover */
            font-weight: bold; /* Bold font weight for text */
        }
        .search-form button:hover {
            background-color: #f0f0f0; /* Light grey background on hover */
        }
        .navigation {
            list-style-type: none; /* Remove list styling */
            margin: 0; padding: 0; /* Remove default margin and padding */
        }
        .navigation li {
            display: inline; /* Display list items inline */
            margin-right: 20px; /* Margin on the right for spacing */
        }
        .navigation a {
            text-decoration: none; /* Remove underline from links */
            color: white; /* Set link color to white */
            font-weight: bold; /* Bold font weight for link text */
        }
        .navigation a:hover {
            border-color: #3c55ff; /* Change border color on hover */
            text-decoration: underline; /* Set underline on hover */
        }
        .container {
            padding: 20px; /* Padding inside the container */
            display: flex; /* Use flexbox for layout */
            width: 80%; /* Set width to 80% of its parent */
            margin: auto; /* Center the container horizontally */
            flex-wrap: wrap; /* Allow items to wrap */
        }
        .news-container{
            width: 30%; /* Set width of each news container */
            margin-bottom: 30px; /* Margin at the bottom for spacing */
            margin-left: 3%; /* Margin on the left for spacing */
        }
        .author-img{
            width: 40px; /* Set width of author image */
            height: 40px; /* Set height of author image */
            border-radius: 100%; /* Circular author images */
        }
        .bottom-div{
            display: flex; /* Use flexbox for layout */
            align-items: center; /* Align items vertically */
            margin-top: 20px; /* Margin on the top for spacing */
        }
        .author-info{
            margin-left: 10px; /* Margin on the left for spacing */
            font-size: 13px; /* Font size for author info */
        }
        .time-div{
            margin-top: 10px; /* Margin on top for spacing */
        }
        .con{
            font-size: 16px; /* Font size for content description */
            color: rgba(0, 0, 0, .54) !important; /* Grey text color */
        }
        .extra-margin {
            margin-right: 30px; /* Additional margin on the right for spacing */
        }
    </style>
</head>
<body>

<div class="header">
    <div class="title">CupidTime</div> <!-- Site title, styled with Dancing Script -->
    <div class="search-box">
        <form class="search-form" action="blog.php" method="GET">
            <input type="text" name="search" placeholder="Search blogs..."> <!-- Input for search queries -->
            <button type="submit">Search</button> <!-- Submit button for the search form -->
        </form>
    </div>
    <ul class="navigation">
        <li><a href="home.php"><i class="fas fa-home"></i> Home</a></li> <!-- Navigation link to the home page -->
        <li><a href="blog.php"><i class="fas fa-blog"></i> Blog</a></li> <!-- Navigation link to the blog page -->
        <li><a href="sub_vip.php"><i class="fas fa-crown"></i> Vip</a></li> <!-- Navigation link to the VIP section -->
        <?php if(!empty($user_id)) {?> <!-- Conditional display based on user login status -->
            <a href="profile.php"class="extra-margin"><i class="fas fa-user-circle"></i> Profile</a> <!-- Link to user profile -->
            <a href="#"class="extra-margin"><?php echo $u['name'] ?></a> <!-- Display user name -->
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i>logout</a> <!-- Logout link -->
            
        <?php }else{ ?>
            <a href="login_page.php">login</a> <!-- Link to login page if user is not logged in -->
        <?php } ?>
    </ul>
</div>

<div class="container">
    <?php foreach ($content as $v) { ?> <!-- Loop through each news article fetched from the database -->
    <div class="news-container" style="cursor: pointer" onclick="skip('<?php echo $v['link']?>')"> <!-- Container for each news article -->
        <img style="width: 100%" src="<?php echo $v['img']?>" alt=""> <!-- Display news image -->
        <h3><?php echo $v['title']?></h3> <!-- Display news title -->
        <div class="con"><?php echo $v['description']?></div> <!-- Display news description -->
        <div class="bottom-div">
            <div>
                <img class="author-img" src="<?php echo $v['author_img']?>" alt=""> <!-- Display author image -->
            </div>
            <div class="author-info">
                <div><?php echo $v['author']?></div> <!-- Display author name -->
                <div class="time-div"><?php echo $v['add_time']?></div> <!-- Display time article was added -->
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<script>
    function skip(link){
        window.open(link); // Function to open the link in a new tab when a news container is clicked
    }
</script>
</body>
</html>
