<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <title>Blog</title>
</head>
<body>
<!-- Include the Bootstrap Navbar -->
<?php require "inc/navbar.inc.php" ?>
<div class="container mt-5">
<div class="row">

<h1 class="mb-5">CTEC 227 Blog</h1>

<?php 
    require "inc/db_connect.inc.php"; // connect to the blog database
    
    // SQL to get all blog posts. Note the use of a JOIN
    $sql = "SELECT post.post_id, post.title, post.date, post.content, author.author_id, author.first_name, author.last_name 
    FROM post 
    JOIN author 
    ON post.author = author.author_id ";

    // PDO Prepared Statements
    $stmt = $db->prepare($sql);
    $stmt->execute();
    
    // Fetch all of the row(s)
    $data = $stmt->fetchAll();

    // Iterate through each of the rows
    foreach($data as $row){
        // Create HTML for each blog entry
        echo "<div class='col-12 mb-5'>";
        // Blog Title
        echo "<h2>{$row->title}</h2>";
        echo "<hr>";
        // Take the date and convert it to a PHP date object
        $date = date_create($row->date);
        // Show blog post author and format the date
        echo "<p class='fw-bold'>{$row->first_name} {$row->last_name} - " . $date->format('M d, Y')  . "</p>";
        
        // Now get the categories for this post with SQL JOIN
        $sql = "SELECT post_category.post_id, post_category.category_id, category.category 
        FROM post_category 
        JOIN category 
        ON post_category.category_id = category.category_id 
        WHERE post_category.post_id = :post_id";
        
        // PDO Prepared statements
        $stmt_category = $db->prepare($sql);
        $stmt_category->execute(["post_id" => $row->post_id]);
        $categories = $stmt_category->fetchAll();
        
        // Generate an unordered list with categories
        echo "<p>Category</p>";
        echo "<ul>";
        foreach($categories as $category_row){
            echo "<li>{$category_row->category}</li>";
        }
        echo "</ul>";
        
        // Show the blog post content
        echo "<p>{$row->content}</p>";
        echo "<a href='#' title='Read the post'>Read more ></a>";
        echo "</div>"; // closing .col-1
    } // end of loop for Posts
?>
</div> <!-- Closing for .row -->
</div> <!-- Closing for .container -->

</body>
</html>