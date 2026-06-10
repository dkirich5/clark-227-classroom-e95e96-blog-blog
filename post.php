<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <title>Blog Post</title>
</head>

<body>
    <?php require "inc/navbar.inc.php" ?>
    <div class="container mt-5">
        <div class="row">

            <?php
            require "inc/db_connect.inc.php";

            // Check if post ID is provided in the URL
            if (!isset($_GET['id']) || empty($_GET['id'])) {
                echo "<div class='alert alert-danger' role='alert'>Post ID is required.</div>";
            } else {
                $post_id = $_GET['id'];

                // SQL to get the specific blog post
                $sql = "SELECT post.post_id, post.title, post.date, post.content, author.author_id, author.first_name, author.last_name 
        FROM post 
        JOIN author 
        ON post.author = author.author_id 
        WHERE post.post_id = :post_id";

                // PDO Prepared Statements
                $stmt = $db->prepare($sql);
                $stmt->execute(["post_id" => $post_id]);

                // Fetch the post
                $post = $stmt->fetch();

                if ($post) {
                    // Display the post
                    echo "<div class='col-12'>";
                    // Blog Title
                    echo "<h1>" . htmlspecialchars($post->title) . "</h1>";
                    echo "<hr>";

                    // Take the date and convert it to a PHP date object
                    $date = date_create($post->date);
                    // Show blog post author and format the date
                    echo "<p class='fw-bold'><a href='author.php?id=" . htmlspecialchars($post->author_id) . "'>" . htmlspecialchars($post->first_name) . " " . htmlspecialchars($post->last_name) . "</a> - " . $date->format('M d, Y') . "</p>";

                    // Now get the categories for this post with SQL JOIN
                    $sql = "SELECT post_category.post_id, post_category.category_id, category.category 
            FROM post_category 
            JOIN category 
            ON post_category.category_id = category.category_id 
            WHERE post_category.post_id = :post_id";

                    // PDO Prepared statements
                    $stmt_category = $db->prepare($sql);
                    $stmt_category->execute(["post_id" => $post->post_id]);
                    $categories = $stmt_category->fetchAll();

                    // Display categories with correct singular/plural label
                    $category_count = count($categories);
                    if ($category_count > 0) {
                        $label = ($category_count === 1) ? "Category" : "Categories";
                        echo "<p><strong>" . $label . ":</strong> ";

                        // Building comma-separated category links
                        $category_links = [];
                        foreach ($categories as $category_row) {
                            $category_links[] = "<a href='category.php?id=" . htmlspecialchars($category_row->category_id) . "'>" . htmlspecialchars($category_row->category) . "</a>";
                        }
                        echo implode(", ", $category_links);
                        echo "</p>";
                    }

                    // Show the blog post content
                    echo "<div class='mt-4'>";
                    echo "<p>" . htmlspecialchars($post->content) . "</p>";
                    echo "</div>";

                    // Back to blog link
                    echo "<p class='mt-4'><a href='blog.php'>← Back to blog</a></p>";
                    echo "</div>";
                } else {
                    echo "<div class='alert alert-danger' role='alert'>Post not found.</div>";
                }
            }
            ?>
        </div>
    </div>

</body>

</html>