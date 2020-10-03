<?php
    session_start();
    require_once('config/Article.php');
    require_once('config/config.php');

    if(empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {
        header("Location: login.php");
      }

    $db = new Article($pdo);
    $result = $db->show($_GET['id'], $_GET['uid']);

    $article = $result[0];
    $user = $result[1];

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
        <div class="card mb-2">
            <div class="card-header">
                <?php echo ucfirst($article['title']) ?>
                <p class="text-secondary my-1 small">Author Name: <?php echo ucfirst($user['name']) ?></p>
            </div>
            <div class="card-body">
                <p class="card-text"><?php echo  $article['content'] ?></p>
                <div class="d-flex justify-content-end">
                    <a href="index.php" class="btn btn-warning">Back</a>
                </div>
            </div>
            </div>
        </div>
    </div>
</body>
</html>