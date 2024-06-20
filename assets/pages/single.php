<?php
include '../../assets/pages/system_files/db_connection.php';

if(isset($_GET['id'])) {
    $news_id = $_GET['id'];
    $sql = "SELECT * FROM news WHERE id = $news_id";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = $row['title'];
        $category = $row['category'];
        $author = $row['author'];
        $date_published = $row['date_published'];
        $image_path = $row['image_path'];
        $content = $row['content'];
    }
}
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Подробнее | InfoinnoVator</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .post-container {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<?php include '../../assets/pages/header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="post-container">
                    <div class="post-content single-post">
                        <?php if(isset($title)): ?>
                            <h3><?php echo $title; ?></h3>
                        <?php endif; ?>
                        <div class="post-information">
                            <?php if(isset($category)): ?>
                                <span><i class='fa fa-tags' aria-hidden='true'></i> <a href='../../assets/pages/category.php?category=<?php echo urlencode($category); ?>'><?php echo $category; ?></a></span>
                            <?php endif; ?>
                            <?php if(isset($author)): ?>
                                <span><i class='fa fa-user' aria-hidden='true'></i> <a href='../../assets/pages/author.php?id=<?php echo urlencode($author); ?>'><?php echo $author; ?></a></span>
                            <?php endif; ?>
                            <?php if(isset($date_published)): ?>
                                <span><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo $date_published; ?></span>
                            <?php endif; ?>
                        </div>
                        <?php if(isset($image_path)): ?>
                            <img class="single-feature-image" src="<?php echo $image_path; ?>" alt=""/>
                        <?php endif; ?>
                        <?php if(isset($content)): ?>
                            <p class="description"><?php echo $content; ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php include '../../assets/pages/sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include '../../assets/pages/footer.php'; ?>
</body>
</html>
