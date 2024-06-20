<?php

include "../system_files/db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $post_id = $_POST["post_id"];
    $post_title = $_POST["post_title"];
    $post_desc = $_POST["postdesc"];
    $category = $_POST["category"];
    $old_image = $_POST["old-image"];

    $sql = "UPDATE news SET title='$post_title', content='$post_desc', category='$category' WHERE id='$post_id'";

    if (mysqli_query($conn, $sql)) {
        if ($_FILES["new-image"]["name"]) {
            // Обработка загрузки нового изображения
            $file_name = $_FILES["new-image"]["name"];
            $file_tmp_name = $_FILES["new-image"]["tmp_name"];
            $file_destination = "../../../assets/img/post/" . $file_name;

            // Перемещение загруженного файла в новое место
            move_uploaded_file($file_tmp_name, $file_destination);

            // Обновление пути к изображению в базе данных
            $update_image_sql = "UPDATE news SET image_path='$file_destination' WHERE id='$post_id'";
            mysqli_query($conn, $update_image_sql);

            // Удаление старого изображения, если это необходимо
            if ($old_image) {
                unlink($old_image);
            }
        }

        header("Location: post.php");
        exit();
    } else {
        header("Location: update-post.php?id=$post_id&error=Failed to update post");
        exit();
    }
} else {
    header("Location: update-post.php?id=$post_id&error=Invalid request");
    exit();
}
?>
