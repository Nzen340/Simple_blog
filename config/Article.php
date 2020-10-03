<?php
    class Article
    {
        public $pdo;
        public function __construct($pdo)
        {
            $this->pdo = $pdo;
        }

        public function index()
        {
            $stm = $this->pdo->prepare("
                SELECT * FROM articles ORDER BY id DESC
            ");

            if($stm->execute()) {
                $articles = $stm->fetchAll(PDO::FETCH_ASSOC);
            }

            if($articles) {
                foreach($articles as $key => $value) {
                    // die(var_dump($articles[$key]));
                    $user_id = $articles[$key]['user_id'];
                    $stmtus = $this->pdo->prepare("SELECT * FROM users WHERE id= :id");
                    $stmtus->bindParam(":id", $user_id);
                    if ($stmtus->execute()) {
                        $user[] = $stmtus->fetch(PDO::FETCH_ASSOC);
                    }            
                }
            }

            return [$articles, $user];
        }

        public function show($id, $uid)
        {
            $stm = $this->pdo->prepare("
                SELECT * FROM articles WHERE id = :id
            ");

            $stm->bindParam(":id", $id);

            if($stm->execute()) {
                $article = $stm->fetch(); 
            }

            $stmt = $this->pdo->prepare("
                SELECT * FROM users WHERE id = :uid
            ");

            $stmt->bindParam(":uid", $uid);

            if($stmt->execute()) {
                $user = $stmt->fetch(); 
            }

            return [$article, $user];
        }
        
        public function store($data)
        {
            $stm = $this->pdo->prepare("
                INSERT INTO articles (user_id, title, content) VALUE
                (:user_id, :title, :content)
            "); 

            $stm->bindParam(":user_id", $_SESSION['user_id']);
            $stm->bindParam(":title", $data['title']);
            $stm->bindParam(":content", $data['content']);

            if ($stm->execute()) {
                header("location: manage.php");
            }
        }

        public function edit($id) 
        {
            $stm = $this->pdo->prepare("
                SELECT * FROM articles WHERE id = :id
            ");

            $stm->bindParam(':id', $id);

            if ($stm->execute()) {
                $result = $stm->fetch(PDO::FETCH_ASSOC);
                return $result;
            }
        }

        public function update($data)
        {
            $stm = $this->pdo->prepare("
                 UPDATE articles SET title= :title, content= :content WHERE id = :id 
            ");
            $stm->bindParam(":title", $data['title']);
            $stm->bindParam(":content", $data['content']);
            $stm->bindParam(":id", $data['id']);

            if ($stm->execute()) {
                header("location: manage.php");
            }
        }

        public function destroy($id) 
        {
            $stm = $this->pdo->prepare("
                DELETE FROM articles WHERE id = :id
            ");
            $stm->bindParam(":id", $id);

            if ($stm->execute()) {
                header('location: manage.php');
            }
        }
    }