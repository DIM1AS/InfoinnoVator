<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$fullname = $_SESSION['fullname'];
$username = $_SESSION['username'];
$logout_link = "logout.php";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Администрирование | InfoinnoVator</title>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../../../assets/css/style.css">
    <link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon">

    <style>
        .admin-logout-container {
            font-size: smaller;
        }
    </style>
</head>
<body>
<div id="header-admin">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-9 col-md-3 admin-logout-container" style="display: inline-block;">
                <span class="admin-logout">Привет, <?php echo $username; ?>!</span>
                <a href="<?php echo $logout_link; ?>" class="btn admin-logout">Выход</a>
            </div>
        </div>
    </div>
</div>

<div id="admin-menubar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="admin-menu">
                    <li>
                        <a href="../admin/post.php">Главная</a>
                    </li>
                    <li>
                        <a href="../admin/new-prodile.php">Редактирование пользователей</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</body>
</html>