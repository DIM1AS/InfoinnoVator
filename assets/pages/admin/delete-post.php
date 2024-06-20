<?php
include "../system_files/db_connection.php";

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $post_id = $_GET['id'];

    $sql = "DELETE FROM news WHERE id = $post_id";

    if(mysqli_query($conn, $sql)) {

        header("Location: post.php");
        exit();
    } else {
        header("Location: admin-posts.php?error=Failed to delete post");
        exit();
    }
} else {
    header("Location: admin-posts.php?error=Invalid request");
    exit();
}
?>
