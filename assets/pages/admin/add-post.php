<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Добавить новый пост</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <form action="add-post-handler.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="post_title">Заголовок</label>
                        <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Описание</label>
                        <textarea name="postdesc" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Категория</label>
                        <select name="category" class="form-control">
                            <option value="Наука и общество">Наука и общество</option>
                            <option value="Эксперименты">Эксперименты</option>
                            <option value="Технологии будущего">Технологии будущего</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Изображение поста</label>
                        <input type="file" name="fileToUpload">
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Сохранить" required />
                </form>
                <?php
                if(isset($_GET['error'])) {
                    echo "<div class='alert alert-danger' role='alert'>" . $_GET['error'] . "</div>";
                } elseif(isset($_GET['success'])) {
                    echo "<div class='alert alert-success' role='alert'>" . $_GET['success'] . "</div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php "footer.php"; ?>