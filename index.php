<?php
// Include the database connection
include 'config/db_connect.php';

// Query to get all posts
$sql = "SELECT * FROM posts ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Free result set
mysqli_free_result($result);

// Close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple PHP Blog</title>
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
            <?php if(empty($posts)): ?>
                <p>No posts found. Create your first post!</p>
            <?php else: ?>
                <?php foreach($posts as $post): ?>
                    <div class="blog-post">
                        <h2><?php echo htmlspecialchars($post['title']); ?></h2>
                        <div class="meta">
                            By <?php echo htmlspecialchars($post['author']); ?> | 
                            <?php echo date('F j, Y, g:i a', strtotime($post['created_at'])); ?>
                        </div>
                        <div class="content">
                            <?php 
                            // Show only a preview of the content
                            $preview = substr($post['content'], 0, 200);
                            echo nl2br(htmlspecialchars($preview));
                            if(strlen($post['content']) > 200) {
                                echo '...';
                            }
                            ?>
                        </div>
                        <div class="actions">
                            <a href="post.php?id=<?php echo $post['id']; ?>" class="btn-read">Read More</a>
                            <a href="edit_post.php?id=<?php echo $post['id']; ?>" class="btn-edit">Edit</a>
                            <a href="delete_post.php?id=<?php echo $post['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>