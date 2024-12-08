<?php 
    if(isset($_POST["btn"]))
    {   
      
        $dbConnection = new DBConnection();
        $conn1 = $dbConnection->getCon();
        
        if ($conn1 != null) {
            try {
                
                $sql = "INSERT INTO news (title, content, image, created_at, category_id) 
                        VALUES (:title, :content, :image, :created_at, :category_id)";
                $stmt = $conn1->prepare($sql);

                
                $date = new DateTime();
                $title = $_POST['title'] ?? '';
                $content = $_POST['content'] ?? '';
                $image = $_POST['image'] ?? '';
                $created_at = $date->format('Y-m-d H:i:s');
                $category_id = $_POST['category_id'] ?? '';

                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':content', $content);
                $stmt->bindParam(':image', $image);
                $stmt->bindParam(':created_at', $created_at); 
                $stmt->bindParam(':category_id', $category_id);

                if ($stmt->execute()) {
                    
                    header("Location:../../../dashboard.php");
                    exit();
                } else {
                    echo "<script>alert('Có lỗi xảy ra, vui lòng thử lại!');</script>";
                }
            } catch (PDOException $e) {
                echo "<script>alert('Lỗi: " . $e->getMessage() . "');</script>";
            }
        } else {
            echo "<script>alert('Không thể kết nối cơ sở dữ liệu!');</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm dữ liệu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="d-flex justify-content-center align-items-center vh-100">
        <form class="bg-white p-4 rounded shadow" action="add.php" method="post" enctype="multipart/form-data" style="width: 300px;">
            <div class="text-center text-primary text-uppercase mb-3"><strong>Thêm tin tức</strong></div>
            <div class="mb-3">
                <label for="title" class="form-label fw-bold">Tiêu đề</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label fw-bold">Nội dung</label>
                <input type="text" class="form-control" id="content" name="content" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label fw-bold">Hình ảnh</label>
                <input type="text" class="form-control" id="image" name="image" required>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label fw-bold">Thể loại</label>
                <input type="text" class="form-control" id="category_id" name="category_id" required>
            </div>
            <button type="submit" class="btn btn-primary w-100" name="btn">Xác nhận</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
