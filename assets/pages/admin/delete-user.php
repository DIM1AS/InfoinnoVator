<?php
include "../system_files/db_connection.php";


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $user_id = intval($_GET['id']);

    $delete_sql = "DELETE FROM users WHERE id = $user_id";
    if (mysqli_query($conn, $delete_sql)) {
        header("Location: new-prodile.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Invalid user ID";
}
?>
