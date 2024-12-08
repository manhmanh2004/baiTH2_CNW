<?php 
    
    require_once APP_ROOT.'/models/News.php';
    require_once APP_ROOT.'/models/User.php';
    class AdminService
    {
        public function getAllNews()
        {
                $dbConnection = new DBConnection();
                $conn = $dbConnection->getCon();
             
                if ($conn != null) {
                    $sql = "select * from news";
                    $stmt = $conn->query($sql);
                    
                    $news = [];
                    while ($row = $stmt->fetch())
                    {
                        $new = new News($row['id'], $row['title'], $row['content'], $row['image'], $row['created_at'], $row['category_id']);
                        $news[] = $new;
                    }
                    return $news;
                }
            
        }
        public function getAdminusers()
        {
            $dbConnection = new DBConnection();
            $conn1 = $dbConnection->getCon();
            
            if ($conn1 != null) {
                $sql = "select * from users";
                $stmt = $conn1->query($sql);

               
                
                while ($row = $stmt->fetch())
                {
                    $user = new User($row['id'], $row['username'], $row['password'], $row['role']);
                    
                }
                return $user;
            }
        }

        public function addNews()
    {
        
    }

    }
?>