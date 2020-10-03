<?php
try{
    $pdo = new PDO("mysql:dbname=simple_blog;host=localhost", 'root', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die($e->getMessage());
} catch(Exception $e) {
    die($e->getMessge());
}