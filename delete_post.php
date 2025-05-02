<?php
// Include the database connection
include 'config/db_connect.php';

// Check if ID is provided
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Get the ID
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Create SQL query to delete post
    $sql = "DELETE FROM posts WHERE id = $id";
    
    // Execute query
    if(mysqli_query($conn, $sql)) {
        // Success - redirect to home page
        header('Location: index.php');
        exit();
    } else {
        // Query failed
        echo "Query error: " . mysqli_error($conn);
    }
} else {
    // If no ID provided, redirect to homepage
    header('Location: index.php');
    exit();
}

// Close connection
mysqli_close($conn);
?>