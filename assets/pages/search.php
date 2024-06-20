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
<?php include '../../assets/pages/header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="post-container">
                    <h2 class="page-heading">Поиск : <?php echo isset($_GET['search']) ? $_GET['search'] : 'Поисковый запрос'; ?></h2>
                    <div class="post-content">
                        <?php
                        include '../../assets/pages/system_files/db_connection.php';
                        if (isset($_GET['search'])) {
                            $search_query = $_GET['search'];
                            $results_per_page = 5; 
                            if (!isset($_GET['page'])) {
                                $page = 1;
                            } else {
                                $page = $_GET['page'];
                            }
                            $start_from = ($page - 1) * $results_per_page;
                            $sql = "SELECT id, title, content, category, author, date_published, image_path 
                                    FROM news 
                                    WHERE title LIKE '%$search_query%' OR content LIKE '%$search_query%'
                                    ORDER BY date_published DESC
                                    LIMIT $start_from, $results_per_page";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<div class='row'>";
                                    echo "<div class='col-md-4'>";
                                    echo "<a class='post-img' href='../../assets/pages/single.php?id=" . $row['id'] . "'><img src='../../" . $row['image_path'] . "' alt=''/></a>";
                                    echo "</div>";
                                    echo "<div class='col-md-8'>";
                                    echo "<div class='inner-content clearfix'>";
                                    echo "<h3><a href='../../assets/pages/single.php?id=" . $row['id'] . "'>" . $row['title'] . "</a></h3>";
                                    echo "<div class='post-information'>";
                                    echo "<span><i class='fa fa-tags' aria-hidden='true'></i> <a href='../../assets/pages/category.php?category=" . urlencode($row['category']) . "'>" . $row['category'] . "</a></span>";
                                    echo "<span><i class='fa fa-user' aria-hidden='true'></i> <a href='../../assets/pages/author.php?id=" . urlencode($row['author']) . "'>" . $row['author'] . "</a></span>";
                                    echo "<span><i class='fa fa-calendar' aria-hidden='true'></i> " . $row['date_published'] . "</span>";
                                    echo "</div>";
                                    echo "<p class='description'>" . $row['content'] . "</p>";
                                    echo "<a class='read-more pull-right' href='../../assets/pages/single.php?id=" . $row['id'] . "'>Подробнее</a>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                            } else {
                                echo "0 результатов";
                            }

                            $sql = "SELECT COUNT(id) AS total FROM news WHERE title LIKE '%$search_query%' OR content LIKE '%$search_query%'";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            $total_pages = ceil($row["total"] / $results_per_page);

                            echo "<ul class='pagination'>";
                            for ($i = 1; $i <= $total_pages; $i++) {
                                echo "<li" . ($i == $page ? " class='active'" : "") . "><a href='?search=" . $search_query . "&page=" . $i . "'>" . $i . "</a></li>";
                            }
                            echo "</ul>";
                        } else {
                            echo "Поисковый запрос не был отправлен.";
                        }

                        $conn->close();
                        ?>
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
