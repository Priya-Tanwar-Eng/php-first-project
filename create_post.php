<?php
// Include the database connection
include 'config/db_connect.php';

$title = $content = $author = '';
$errors = ['title' => '', 'content' => '', 'author' => ''];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check and sanitize title
    if (empty($_POST['title'])) {
        $errors['title'] = 'A title is required';
    } else {
        $title = mysqli_real_escape_string($conn, $_POST['title']);
    }
    
    // Check and sanitize content
    if (empty($_POST['content'])) {
        $errors['content'] = 'Content is required';
    } else {
        $content = mysqli_real_escape_string($conn, $_POST['content']);
    }
    
    // Check and sanitize author
    if (empty($_POST['author'])) {
        $errors['author'] = 'Author name is required';
    } else {
        $author = mysqli_real_escape_string($conn, $_POST['author']);
    }
    
    // If no errors, insert post into database
    if (!array_filter($errors)) {
        $sql = "INSERT INTO posts (title, content, author) VALUES ('$title', '$content', '$author')";
        
        if (mysqli_query($conn, $sql)) {
            // Redirect to homepage
            header('Location: index.php');
            exit();
        } else {
            echo "Query error: " . mysqli_error($conn);
        }
    }
}

// Close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Post</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Create New Blog Post</h1>
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
            <form action="create_post.php" method="POST">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="<?php echo htmlspecialchars($title); ?>">
                    <div class="error"><?php echo $errors['title']; ?></div>
                </div>
                
                <div class="form-group">
                    <label for="author">Author</label>
                    <input type="text" name="author" id="author" class="form-control" value="<?php echo htmlspecialchars($author); ?>">
                    <div class="error"><?php echo $errors['author']; ?></div>
                </div>
                
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" class="form-control"><?php echo htmlspecialchars($content); ?></textarea>
                    <div class="error"><?php echo $errors['content']; ?></div>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn-submit">Create Post</button>
                </div>
            </form>
            
            <a href="index.php" class="back-link">&larr; Back to all posts</a>
        </main>
    </div>
</body>
</html>