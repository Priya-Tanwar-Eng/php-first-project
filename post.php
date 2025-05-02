<?php
// Include the database connection
include 'config/db_connect.php';

// Check if ID is provided
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Get the ID
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Query to get the post
    $sql = "SELECT * FROM posts WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    
    // Check if post exists
    if(mysqli_num_rows($result) == 0) {
        header('Location: index.php');
        exit();
    }
    
    // Fetch the post
    $post = mysqli_fetch_assoc($result);
    
    // Free result set
    mysqli_free_result($result);
    
    // Close connection
    mysqli_close($conn);
} else {
    // If no ID provided, redirect to homepage
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['title']); ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>My Simple Blog</h1>
        </div>
    </header>
    
    <div class="container">
        <nav>
            <div class="nav-links">
                <a href="index.php">Home</a>
                <a href="create_post.php">Create New Post</a>
            </div>
        </nav>
        
        <main>
            <div class="blog-post">
                <h2><?php echo htmlspecialchars($post['title']); ?></h2>
                <div class="meta">
                    By <?php echo htmlspecialchars($post['author']); ?> | 
                    <?php echo date('F j, Y, g:i a', strtotime($post['created_at'])); ?>
                </div>
                <div class="content">
                    <?php echo nl2br(htmlspecialchars($post['content'])); ?>
                </div>
                <div class="actions">
                    <a href="edit_post.php?id=<?php echo $post['id']; ?>" class="btn-edit">Edit</a>
                    <a href="delete_post.php?id=<?php echo $post['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>
                </div>
            </div>
            
            <a href="index.php" class="back-link">&larr; Back to all posts</a>
        </main>
    </div>
</body>
</html>