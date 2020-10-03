<?php 
    session_start(); 
    require_once('config/Article.php');
    require_once('config/config.php');

    if(empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {
        header("Location: login.php");
      }

    $db = new Article($pdo);
    $result = $db->index();
    // die(var_dump($result));
    $articles = $result[0];
    $user = $result[1];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav>
    <div class="logo">
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-book-half" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M8.5 2.687v9.746c.935-.53 2.12-.603 3.213-.493 1.18.12 2.37.461 3.287.811V2.828c-.885-.37-2.154-.769-3.388-.893-1.33-.134-2.458.063-3.112.752zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
        </svg>
    </div>
    <ul>
        <li><a href="" class="text-success">Article</a></li>
        <li><a href="manage.php"  class="text-success">Article Manage</a></li>
        <li>
            <div class="input-group-append">
                <button class="btn btn-outline-success dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo ucfirst($_SESSION['user_name']) ?></button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </div>
    </li>
    </ul>
</nav>

<div class="container mt-5">
    <div class="row">
        <div class="col">
                <?php foreach($articles as $key => $article): ?>
                    <div class="card border-secondary mb-3">
                        <div class="card-header">
                            <?php echo ucfirst($article['title']) ?>
                            <p class="text-secondary my-1 small">Author Name: <?php echo ucfirst($user[$key]['name']) ?></p>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><?php echo substr( $article['content'],0, 150) ?>...</p>
                            <a href="detail.php?id=<?php echo $article['id'] ?>&uid=<?php echo $user[$key]['id'] ?>" class="view-detail">View Detail &raquo;</a>
                        </div>
                    </div>
                <?php endforeach; ?>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>