<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <title>Author</title>
</head>

<body>
    <?php require "inc/navbar.inc.php" ?>
    <div class="container mt-5">
        <div class="row">

            <?php
            require "inc/db_connect.inc.php";

            // Check if author ID is provided in the URL
            if (!isset($_GET['id']) || empty($_GET['id'])) {
                echo "<div class='alert alert-danger' role='alert'>Author ID is required.</div>";
            } else {
                $author_id = $_GET['id'];

                // Get the author name
                $sql_author = "SELECT author_id, first_name, last_name FROM author WHERE author_id = :author_id";
                $stmt_author_name = $db->prepare($sql_author);
                $stmt_author_name->execute(["author_id" => $author_id]);
                $author = $stmt_author_name->fetch();

                if ($author) {
                    // SQL to get all blog posts by this author
                    $sql = "SELECT post.post_id, post.title, post.date, post.content, author.author_id, author.first_name, author.last_name 
            FROM post 
            JOIN author 
            ON post.author = author.author_id 
            WHERE author.author_id = :author_id
            ORDER BY post.date DESC";

                    // PDO Prepared Statements
                    $stmt = $db->prepare($sql);
                    $stmt->execute(["author_id" => $author_id]);

                    // Fetch all of the row/rows
                    $data = $stmt->fetchAll();

                    // Display the author name as heading
                    echo "<h1 class='mb-5'>Posts by " . htmlspecialchars($author->first_name) . " " . htmlspecialchars($author->last_name) . "</h1>";

                    if (count($data) === 0) {
                        // No posts found
                        echo "<div class='alert alert-info' role='alert'>No posts were found for this author.</div>";
                    } else {
                        // Iterate through each of the rows
                        foreach ($data as $row) {
                            // Create HTML for each blog entry
                            echo "<div class='col-12 mb-5'>";
                            // Blog Title
                            echo "<h2><a href='post.php?id=" . htmlspecialchars($row->post_id) . "'>" . htmlspecialchars($row->title) . "</a></h2>";
                            echo "<hr>";
                            // Take the date and convert it to a PHP date object
                            $date = date_create($row->date);
                            // Show blog post author and format the date
                            echo "<p class='fw-bold'>" . htmlspecialchars($row->first_name) . " " . htmlspecialchars($row->last_name) . " - " . $date->format('M d, Y')  . "</p>";

                            // Get the categories for this post with SQL JOIN
                            $sql_cats = "SELECT post_category.post_id, post_category.category_id, category.category 
                    FROM post_category 
                    JOIN category 
                    ON post_category.category_id = category.category_id 
                    WHERE post_category.post_id = :post_id";

                            // PDO Prepared statements
                            $stmt_categories = $db->prepare($sql_cats);
                            $stmt_categories->execute(["post_id" => $row->post_id]);
                            $categories = $stmt_categories->fetchAll();

                            // Display categories with correct singular/plural label
                            $category_count = count($categories);
                            if ($category_count > 0) {
                                $label = ($category_count === 1) ? "Category" : "Categories";
                                echo "<p><strong>" . $label . ":</strong> ";

                                // Build comma-separated category links
                                $category_links = [];
                                foreach ($categories as $category_row) {
                                    $category_links[] = "<a href='category.php?id=" . htmlspecialchars($category_row->category_id) . "'>" . htmlspecialchars($category_row->category) . "</a>";
                                }
                                echo implode(", ", $category_links);
                                echo "</p>";
                            }

                            // Show the blog post content
                            echo "<p>" . htmlspecialchars($row->content) . "</p>";
                            echo "<a href='post.php?id=" . htmlspecialchars($row->post_id) . "' title='Read the post'>Read more ></a>";
                            echo "</div>";
                        } // end of loop for Posts
                    }
                } else {
                    echo "<div class='alert alert-danger' role='alert'>Author not found.</div>";
                }
            }
            ?>
        </div>
    </div>

    <?php require "inc/footer.inc.php" ?>
</body>

</html>