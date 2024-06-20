<?php include "header.php"; ?>
<?php
include "../system_files/db_connection.php";


function generateRandomPassword($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Проверка на существование пользователя с таким же именем
    $check_sql = "SELECT * FROM users WHERE username = '$username'";
    $check_result = mysqli_query($conn, $check_sql);
    if (mysqli_num_rows($check_result) > 0) {
        //echo "Пользователь с таким именем уже существует. Пожалуйста, выберите другое имя пользователя.";
    } else {
        $insert_sql = "INSERT INTO users (fullname, email, username, password) VALUES ('$fullname', '$email', '$username', '$password')";
        if (mysqli_query($conn, $insert_sql)) {
            header("Location: new-prodile.php");
            exit();
        } else {
            //echo "Error: " . $insert_sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>

<div id="admin-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="page-title">Добавить пользователя</h2>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <label for="fullname">ФИО:</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Имя пользователя:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Пароль:</label>
                        <input type="text" class="form-control" id="password" name="password" value="<?php echo generateRandomPassword(); ?>" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>