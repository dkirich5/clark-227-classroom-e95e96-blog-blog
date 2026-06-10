<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="blog.php">📝 Blog</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="blog.php">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categories
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
            <?php
            require "db_connect.inc.php";

            // Get all categories in alphabetical order
            $sql = "SELECT category_id, category FROM category ORDER BY category ASC";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $categories = $stmt->fetchAll();

            foreach ($categories as $cat) {
              echo "<li><a class='dropdown-item' href='category.php?id=" . htmlspecialchars($cat->category_id) . "'>" . htmlspecialchars($cat->category) . "</a></li>";
            }
            ?>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>