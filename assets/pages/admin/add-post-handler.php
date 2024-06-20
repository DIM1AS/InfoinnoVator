<?php
session_start();

include "../system_files/db_connection.php";

if (isset($_POST['submit'])) {
    $post_title = $_POST['post_title'];
    $post_desc = $_POST['postdesc'];
    $category = $_POST['category'];
    $author = isset($_SESSION['username']) ? $_SESSION['username'] : 'Unknown'; // Предполагается, что автор сохранен в сессии

    if ($_FILES["fileToUpload"]["name"]) {
        $upload_directory = "../../../assets/img/post/";
        $target_file = $upload_directory . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        while (file_exists($target_file)) {
            $filename = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_FILENAME);
            $extension = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
            $target_file = $upload_directory . $filename . "_" . time() . "." . $extension;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            // if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            //     echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
            // } else {
            //     echo "Sorry, there was an error uploading your file.";
            // }
        }
    } else {
        $target_file = null;
    }

    // Записываем данные в базу данных
    $sql = "INSERT INTO news (title, content, category, author, image_path) VALUES ('$post_title', '$post_desc', '$category', '$author', '$target_file')";
    if (mysqli_query($conn, $sql)) {

        $post_id = mysqli_insert_id($conn);

        header("Location: post.php?id=$post_id");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
