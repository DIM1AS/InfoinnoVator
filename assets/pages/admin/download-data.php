<?php
include "../system_files/db_connection.php";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $user_id = intval($_GET['id']);

    $sql = "SELECT * FROM users WHERE id = $user_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $message = "Здравствуйте!\n";
        $message .= "Вот ваши данные для входа на сайт:\n";
        $message .= "ФИО: " . $row['fullname'] . "\n";
        $message .= "Имя пользователя: " . $row['username'] . "\n";
        $message .= "Email: " . $row['email'] . "\n";
        $message .= "Пароль: " . $row['password'] . "\n";

        header('Content-Type: text/plain');
        header('Content-Disposition: attachment; filename="Данные авторизации.txt"');

        echo $message;
        exit();
    }
}

echo "Ошибка: Пользователь не найден.";
?>
