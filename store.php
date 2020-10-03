<?php
    session_start();
    require_once('config/Article.php');
    require_once('config/config.php');

    if(empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {
        header("Location: login.php");
    }

    $db = new Article($pdo);
    $db->store($_POST);