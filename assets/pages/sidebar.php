<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная | InfoinnoVator</title>
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
<div id="sidebar" class="col-md-4">
    <div class="search-box-container">
        <h4>Поиск</h4>
        <form class="search-post" action="../../assets/pages/search.php" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Введите запрос .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Найти</button>
                </span>
            </div>
        </form>
    </div>
    <div class="recent-post-container">
        <h4>Последние новости</h4>
        <?php
        include 'system_files/db_connection.php';
        $sql = "SELECT id, title, content, category, author, date_published, image_path FROM news ORDER BY date_published DESC LIMIT 5";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='recent-post'>";
                echo "<a class='post-img' href='../../assets/pages/single.php?id=" . $row['id'] . "'>";
                echo "<img src='../../" . $row['image_path'] . "' alt=''/>";
                echo "</a>";
                echo "<div class='post-content'>";
                echo "<h5><a href='../../assets/pages/single.php?id=" . $row['id'] . "'>" . $row['title'] . "</a></h5>";
                echo "<span><i class='fa fa-tags' aria-hidden='true'></i> <a href='../../assets/pages/category.php?category=" . urlencode($row['category']) . "'>" . $row['category'] . "</a></span>";
                echo "<span><i class='fa fa-calendar' aria-hidden='true'></i> " . $row['date_published'] . "</span>";
                echo "<a class='read-more' href='../../assets/pages/single.php?id=" . $row['id'] . "'>Подробнее</a>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "0 результатов";
        }
        $conn->close();
        ?>
    </div>
</div>
</body>
</html>
