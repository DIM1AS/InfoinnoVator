<?php
include "../system_files/db_connection.php";
include "header.php";

$posts_per_page = 10;

$total_posts_sql = "SELECT COUNT(*) AS total FROM news";
$total_posts_result = mysqli_query($conn, $total_posts_sql);
$total_posts = mysqli_fetch_assoc($total_posts_result)['total'];

$total_pages = ceil($total_posts / $posts_per_page);

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

$offset = ($current_page - 1) * $posts_per_page;

$sql = "SELECT * FROM news LIMIT $offset, $posts_per_page";
$result = mysqli_query($conn, $sql);

?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">Все посты</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-post.php">Добавить пост</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                    <th>№</th>
                    <th>Заголовок</th>
                    <th>Категория</th>
                    <th>Дата</th>
                    <th>Автор</th>
                    <th>Редактировать</th>
                    <th>Удалить</th>
                    </thead>
                    <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        $counter = ($current_page - 1) * $posts_per_page + 1;
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td class='id'>" . htmlspecialchars($counter++) . "</td>";
                            echo "<td>" . htmlspecialchars($row["title"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["category"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["date_published"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["author"]) . "</td>";
                            echo "<td class='edit'><a href='update-post.php?id=" . $row["id"] . "'><i class='fa fa-edit'></i></a></td>";
                            echo "<td class='delete'><a href='delete-post.php?id=" . $row["id"] . "'><i class='fas fa-trash-alt'></i>
</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>Посты не найдены</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
                <ul class='pagination admin-pagination'>
                    <?php
                    for ($page = 1; $page <= $total_pages; $page++) {
                        echo "<li><a href='admin-posts.php?page=$page'>$page</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>

