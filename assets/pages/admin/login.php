<?php
include "../system_files/db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT id, email, password, fullname, role, username FROM users WHERE email=? LIMIT 1";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Ошибка при подготовке запроса: " . $conn->error);
    }

    if (!$stmt->bind_param("s", $email)) {
        die("Ошибка при привязке параметров: " . $stmt->error);
    }

    if (!$stmt->execute()) {
        die("Ошибка при выполнении запроса: " . $stmt->error);
    }

    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $db_email, $db_password, $fullname, $role, $username);
        $stmt->fetch();

        if ($password === $db_password) {
            session_start();
            $_SESSION['user_id'] = $id;
            $_SESSION['email'] = $email;
            $_SESSION['fullname'] = $fullname;
            $_SESSION['role'] = $role;
            $_SESSION['username'] = $username;

            header("Location: post.php");
            exit();
        } else {
            echo "<p>Неверная почта или пароль. Пожалуйста, попробуйте снова.</p>";
        }
    } else {
        echo "<p>Неверная почта или пароль. Пожалуйста, попробуйте снова.</p>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Авторизация | InfoinnoVator</title>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../../assets/css/font-awesome.css">
    <link rel="stylesheet" href="../../../assets/css/style.css">
    <link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon">
</head>
<body>
<div id="wrapper-admin" class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-4 col-md-4">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <div class="form-group">
                        <label>Почта</label>
                        <input type="email" name="email" class="form-control" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>Пароль</label>
                        <input type="password" name="password" class="form-control" placeholder="" required>
                    </div>
                    <input type="submit" name="login" class="btn btn-primary" value="Войти" />
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
