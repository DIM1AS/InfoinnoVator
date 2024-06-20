<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Автор | InfoinnoVator</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/font-awesome.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon">

</head>

<body>
<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="post-container">
                    <?php
                    include '../../assets/pages/system_files/db_connection.php';

                    $author_id = isset($_GET['id']) ? $_GET['id'] : '';

                    $limit = 5; 
                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $offset = ($page - 1) * $limit;

                    $sql = "SELECT id, title, content, category, author, date_published, image_path 
                                FROM news 
                                WHERE author = '$author_id' 
                                ORDER BY date_published DESC
                                LIMIT $limit OFFSET $offset";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo "<h2 class='page-heading'>Автор: " . $author_id . "</h2>";
                        echo "<div class='post-content'>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='row'>";
                            echo "<div class='col-md-4'>";
                            echo "<a class='post-img' href='../../assets/pages/single.php?id=" . $row['id'] . "'><img src='" . $row['image_path'] . "' alt=''/></a>";
                            echo "</div>";
                            echo "<div class='col-md-8'>";
                            echo "<div class='inner-content clearfix'>";
                            echo "<h3><a href='../../assets/pages/single.php?id=" . $row['id'] . "'>" . $row['title'] . "</a></h3>";
                            echo "<div class='post-information'>";
                            echo "<span><i class='fa fa-tags' aria-hidden='true'></i> <a href='../../assets/pages/category.php?category=" . urlencode($row['category']) . "'>" . $row['category'] . "</a></span>";
                            echo "<span><i class='fa fa-user' aria-hidden='true'></i> <a href='../../assets/pages/author.php?id=" . urlencode($row['author']) . "'>" . $row['author'] . "</a></span>";                            echo "<span><i class='fa fa-calendar' aria-hidden='true'></i> " . $row['date_published'] . "</span>";
                            echo "</div>";
                            echo "<p class='description'>" . $row['content'] . "</p>";
                            echo "<a class='read-more pull-right' href='../../assets/pages/single.php?id=" . $row['id'] . "'>Подробнее</a>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                        echo "</div>";

                        $sql_count = "SELECT COUNT(*) AS count FROM news WHERE author = '$author_id'";
                        $result_count = $conn->query($sql_count);
                        $row_count = $result_count->fetch_assoc();
                        $total_pages = ceil($row_count['count'] / $limit);

                        echo "<ul class='pagination'>";
                        if ($page > 1) {
                            echo "<li><a href='?id=$author_id&page=" . ($page - 1) . "'>&laquo;</a></li>";
                        }
                        for ($i = 1; $i <= $total_pages; $i++) {
                            echo "<li><a href='?id=$author_id&page=$i'>$i</a></li>";
                        }
                        if ($page < $total_pages) {
                            echo "<li><a href='?id=$author_id&page=" . ($page + 1) . "'>&raquo;</a></li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "<h2 class='page-heading'>Автор: " . $author_id . "</h2>";
                        echo "<p>Нет результатов для выбранного автора.</p>";
                    }
                    $conn->close();
                    ?>


                </div>
            </div>
            <?php include '../../assets/pages/sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include '../../assets/pages/footer.php'; ?>
</body>

</html>
