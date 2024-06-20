<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Категория | InfoinnoVator</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .post-container {
            margin-bottom: 20px; /* отступ между постами */
        }
    </style>

</head>

<body>
<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="post-container">
                    <h2 class="page-heading">Категория: <?php echo isset($_GET['category']) ? $_GET['category'] : 'Не указана'; ?></h2>
                    <div class="post-content">
                        <?php
                        include '../../assets/pages/system_files/db_connection.php';

                        $selected_category = isset($_GET['category']) ? $_GET['category'] : '';

                        $sql = "SELECT id, title, content, category, author, date_published, image_path 
                                    FROM news 
                                    WHERE category = '$selected_category' 
                                    ORDER BY date_published DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<div class='row post-row'>"; // Добавленный класс "post-row"
                                echo "<div class='col-md-4'>";
                                echo "<a class='post-img' href='../../assets/pages/single.php?id=" . $row['id'] . "'><img src='" . $row['image_path'] . "' alt=''/></a>";
                                echo "</div>";
                                echo "<div class='col-md-8'>";
                                echo "<div class='inner-content clearfix'>";
                                echo "<h3><a href='../../assets/pages/single.php?id=" . $row['id'] . "'>" . $row['title'] . "</a></h3>";
                                echo "<div class='post-information'>";
                                echo "<span><i class='fa fa-tags' aria-hidden='true'></i> <a href='../../assets/pages/category.php?category=" . urlencode($row['category']) . "'>" . $row['category'] . "</a></span>";
                                echo "<span><i class='fa fa-user' aria-hidden='true'></i> <a href='../../assets/pages/author.php?id=" . urlencode($row['author']) . "'>" . $row['author'] . "</a></span>";                                echo "<span><i class='fa fa-calendar' aria-hidden='true'></i> " . $row['date_published'] . "</span>";
                                echo "</div>";
                                echo "<p class='description'>" . $row['content'] . "</p>";
                                echo "<a class='read-more pull-right' href='../../assets/pages/single.php?id=" . $row['id'] . "'>Подробнее</a>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                            }

                        } else {
                            echo "Нет результатов для выбранной категории.";
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
