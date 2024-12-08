<?php 
    
    require_once APP_ROOT.'/models/News.php';
    require_once APP_ROOT.'/models/User.php';
    require_once APP_ROOT.'/models/Category.php';
    class AdminService
    {
        public function getAllNews()
        {
                $dbConnection = new DBConnection();
                $conn = $dbConnection->getCon();
                // truy van du lieu
                if ($conn != null) {
                    $sql = "select * from news";
                    $stmt = $conn->query($sql);
                    // xu ly du lieu tra ve
                    $news = [];
                    while ($row = $stmt->fetch())
                    {
                        $new = new News($row['id'], $row['title'], $row['content'], $row['image'], $row['created_at'], $row['category_id']);
                        $news[] = $new;
                    }
                    return $news;
                }
            
        }
        public function getNew($id)
        {
                $dbConnection = new DBConnection();
                $conn = $dbConnection->getCon();
                // truy van du lieu
                if ($conn != null) {
                    $sql = "select * from news where $id";
                    $stmt = $conn->query($sql);
                    // xu ly du lieu tra ve
                    while ($row = $stmt->fetch())
                    {
                        $new = new News($row['id'], $row['title'], $row['content'], $row['image'], $row['created_at'], $row['category_id']);
                    }
                    return $new;
                }
            
        }
        public function getAdminusers()
        {
            $dbConnection = new DBConnection();
            $conn1 = $dbConnection->getCon();
            // truy van du lieu
            if ($conn1 != null) {
                $sql = "select * from users";
                $stmt = $conn1->query($sql);

                // xu ly du lieu tra ve
                
                while ($row = $stmt->fetch())
                {
                    $user = new User($row['id'], $row['username'], $row['password'], $row['role']);
                    
                }
                return $user;
            }
        }
        public function addNews()
        {
            $dbConnection = new DBConnection();
            $conn1 = $dbConnection->getCon();
            // truy van du lieu
            if ($conn1 != null) {
                $sql = "INSERT INTO news (title, content, image ,created_at , category_id) VALUES (:title, :content, :image,getdate(),:category_id)";
                $stmt = $conn1->prepare($sql);
                // Liên kết tham số
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':content', $content);
                $stmt->bindParam(':author', $image);
                $stmt->bindParam(':author', $category_id);
                // Thực hiện câu lệnh
                $stmt->execute();
            }
        }

        public function getAllCategorys()
        {
            $dbConnection = new DBConnection();
            $conn1 = $dbConnection->getCon();
            // truy van du lieu
            if ($conn1 != null) {
                $sql = "select * from categorys limit 0,10 ";
                $stmt = $conn1->query($sql);
                $categories = [];
                // xu ly du lieu tra ve
                
                while ($row = $stmt->fetch())
                {
                    $category = new Category($row['id'],$row['name']);
                    $categories[] = $category;
                }
                return $categories;
            }
           
        }
    }
?>