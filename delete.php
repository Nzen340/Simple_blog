<?php
    require_once('config/Article.php');
    require_once('config/config.php');

    $db = new Article($pdo);
    $db->destroy($_GET['id']);