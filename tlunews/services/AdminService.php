<?php 
    
    require_once APP_ROOT.'/models/News.php';
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
    }
?>