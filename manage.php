<?php
     session_start(); 
     require_once('config/Article.php');
     require_once('config/config.php');
 
     if(empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {
         header("Location: login.php");
       }
       
       $db = new Article($pdo);
       $result = $db->index();
       $articles = $result[0];
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
        <div class="card">
            <div class="card-header">
                <a href="create.php" class="btn btn-success">New Article</a>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                   <?php $i = 1; foreach($articles as $article): ?>
                        <tr>
                            <th scope="row"><?php echo $i ?></th>
                            <td><?php echo $article['title'] ?></td>
                            <td><?php echo substr($article['content'], 0, 60) ?>...</td>
                            <td>
                                <a href="edit.php?id=<?php echo $article['id'] ?>" class="btn btn-warning">Edit</a>
                                <a href="delete.php?id=<?php echo $article['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item')">Delete</a>
                            </td>
                        </tr> 
                        <?php $i++ ?>
                   <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mt-4">
            <a href="index.php" class="btn btn-warning">Back To Index Page</a>
        </div>
    </div>
</body>
</html>