<?php
include "../system_files/db_connection.php";
include "header.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_POST['user_id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];

    $update_sql = "UPDATE users SET fullname='$fullname', email='$email', username='$username' WHERE id=$user_id";
    
    if (mysqli_query($conn, $update_sql)) {
        header("Location: new-prodile.php");
        exit();
    } else {
        echo "Error: " . $update_sql . "<br>" . mysqli_error($conn);
    }
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $user_id = intval($_GET['id']);
    $user_sql = "SELECT * FROM users WHERE id = $user_id";
    $user_result = mysqli_query($conn, $user_sql);
    $user = mysqli_fetch_assoc($user_result);
}
?>

<div id="admin-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="page-title">Редактировать пользователя</h2>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                    <div class="form-group">
                        <label for="fullname">ФИО:</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $user['fullname']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Имя пользователя:</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>