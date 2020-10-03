<?php
     session_start(); 
     require_once('config/Article.php');
     require_once('config/config.php');
 
     if(empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {
         header("Location: login.php");
       }
       
       $db = new Article($pdo);
       $article = $db->edit($_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <form action="update.php" method="POST">
       <input type="hidden" name="id" value="<?php echo $article['id'] ?>">
        <div class="form-group">
            <label for="">Title</label>
            <input type="text" name="title" value="<?php echo $article['title'] ?>" class="form-control">
        </div>

        <div class="form-group">
            <label for="">Content</label>
            <textarea name="content" rows="10" class="form-control"><?php echo $article['content'] ?></textarea>
        </div>

        <div class="d-flex justify-content-end">
        <button class="btn btn-primary mr-2">Update</button>
        <a href="manage.php" class="btn btn-warning">Back</a>
        </div>
    </form>
</div>
</body>
</html>