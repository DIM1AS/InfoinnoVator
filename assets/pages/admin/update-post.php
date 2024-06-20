<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Обновить пост | InfoinnoVator</title>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../../assets/css/font-awesome.css">
    <link rel="stylesheet" href="../../../assets/css/style.css">
    <link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon">
</head>
<body>
<?php
include "header.php";
include "../system_files/db_connection.php";
?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Обновить пост</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <form action="update-post-handler.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <?php
                    if(isset($_GET['id'])) {
                        $post_id = $_GET['id'];

                        $sql = "SELECT * FROM news WHERE id = $post_id";
                        $result = mysqli_query($conn, $sql);

                        if(mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            ?>
                            <input type="hidden" name="post_id" value="<?php echo $row['id']; ?>">
                            <div class="form-group">
                                <label for="exampleInputTile">Заголовок</label>
                                <input type="text" name="post_title" class="form-control" id="exampleInputUsername" value="<?php echo $row['title']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Описание</label>
                                <textarea name="postdesc" class="form-control" required rows="5"><?php echo $row['content']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputCategory">Категория</label>
                                <select class="form-control" name="category">
                                    <option value="Наука и общество" <?php if($row['category'] == 'Наука и общество') echo 'selected'; ?>>Наука и общество</option>
                                    <option value="Эксперименты" <?php if($row['category'] == 'Эксперименты') echo 'selected'; ?>>Эксперименты</option>
                                    <option value="Технологии будущего" <?php if($row['category'] == 'Технологии будущего') echo 'selected'; ?>>Технологии будущего</option>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="">Изображение поста</label>
                                <input type="file" name="new-image">
                                <img src="<?php echo $row['image_path']; ?>" height="150px">
                                <input type="hidden" name="old-image" value="<?php echo $row['image_path']; ?>">
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Обновить" />
                            <?php
                        } else {
                            echo "<p>Post not found.</p>";
                        }
                    } else {
                        echo "<p>Post ID not provided.</p>";
                    }
                    mysqli_close($conn);
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>

</body>
</html>
