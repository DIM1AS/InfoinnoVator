<?php
include "../system_files/db_connection.php";
include "header.php";

$users_per_page = 5;

$total_users_sql = "SELECT COUNT(*) AS total FROM users";
$total_users_result = mysqli_query($conn, $total_users_sql);
$total_users = mysqli_fetch_assoc($total_users_result)['total'];

$total_pages = ceil($total_users / $users_per_page);

$current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;

if ($current_page < 1) {
    $current_page = 1;
} elseif ($current_page > $total_pages) {
    $current_page = $total_pages;
}

$offset = ($current_page - 1) * $users_per_page;

$sql = "SELECT * FROM users LIMIT $offset, $users_per_page";
$result = mysqli_query($conn, $sql);

?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">Все пользователи</h1>
            </div>
            <div class="col-md-2">
                <a href="add-user.php" class="btn btn-success"><i class="fas fa-user-plus"></i> Добавить
                    пользователя</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                    <th>№</th>
                    <th>ФИО</th>
                    <th>Email</th>
                    <th>Имя пользователя</th>
                    <th>Редактировать</th>
                    <th>Скачать данные</th>
                    <th>Удалить</th>
                    </thead>
                    <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        $counter = ($current_page - 1) * $users_per_page + 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td class='id'>" . htmlspecialchars($counter++) . "</td>";
                            echo "<td>" . htmlspecialchars($row["fullname"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["username"]) . "</td>";
                            echo "<td class='edit'><a href='update-user.php?id=" . $row["id"] . "'><i class='fa fa-edit'></i></a></td>";
                            echo "<td><a href='download-data.php?id=" . $row["id"] . "' class='btn btn-primary'><i class='fas fa-download'></i></a></td>";

                            echo "<td class='delete'><a href='delete-user.php?id=" . $row["id"] . "' onclick='return confirm(\"Вы уверены, что хотите удалить этого пользователя?\")'><i class='fas fa-trash-alt'></i></a></td>";
                            echo "</tr>";
                        }


                    } else {
                        echo "<tr><td colspan='7'>Пользователи не найдены</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
                <ul class='pagination admin-pagination'>
                    <?php
                    for ($page = 1; $page <= $total_pages; $page++) {
                        echo "<li class='" . ($page == $current_page ? 'active' : '') . "'><a href='new-prodile.php?page=$page'>$page</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
