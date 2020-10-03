<?php
class User
{
    public $pdo;
    public function __construct($pdo)
    {   
       $this->pdo = $pdo;
    }
    public function userLogin()
    {
        if ($_POST) {
            $stm = $this->pdo->prepare("
                SELECT * FROM users WHERE email = :email
            "); 
            $stm->bindParam(":email", $_POST['email']);
            if ($stm->execute()) {
                $user = $stm->fetch();
            }

           if ($user) {
                if($user['password'] == $_POST['password']) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['name'];
                    $_SESSION['logged_in'] = time();
            
                    header("Location: index.php");
                } else {
                    echo "<script>alert('Password is wrong!');</script>";
                }
           } else {
                echo "<script>alert('Email & Password wrong!');</script>";
           }           
        }
    }

    public function userRegister()
    {
        if ($_POST) {
            $stm = $this->pdo->prepare("
                SELECT * FROM users WHERE email = :email
            ");

            $stm->bindParam(":email", $_POST['email']);

            if ($stm->execute()) {
                $user = $stm->fetch();
            }

            if($user) {
                echo "<scritp>alert('Email is duplicated!')</scrpit>";
            } else {
                $statement = $this->pdo->prepare("
                    INSERT INTO users (name, email, password) VALUE 
                    (:name, :email, :password)
                ");
                $statement->bindParam(":name", $_POST['name']);
                $statement->bindParam(":email", $_POST['email']);
                $statement->bindParam(":password", $_POST['password']);

                if ($statement->execute()) {
                    echo "<script>alert('Successfully register;You can login now');window.location.href='login.php';</script>";
                }
            }
        }
    }
}