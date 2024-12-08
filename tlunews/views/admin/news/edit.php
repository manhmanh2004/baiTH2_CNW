<?php 
if(isset($_POST["btn"])) {   
    
    $dbConnection = new DBConnection();
    $conn1 = $dbConnection->getCon();
    
    if ($conn1 != null) {
        try {
           
            $id = $_GET['id']; 

            
            $sql = "UPDATE news SET title = :title, content = :content, image = :image, category_id = :category_id 
                    WHERE id = :id";
            $stmt = $conn1->prepare($sql);

            
            $title = $_POST['title'] ?? '';
            $content = $_POST['content'] ?? '';
            $image = $_POST['image'] ?? '';
            $category_id = $_POST['category_id'] ?? '';

            
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':category_id', $category_id);
            $stmt->bindParam(':id', $id);

            
            if ($stmt->execute()) {
               
                header("Location: /index.php?controller=admin&action=dashboards");
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
} else {
    
    $id = $_GET['id'];
    $dbConnection = new DBConnection();
    $conn1 = $dbConnection->getCon();
    $sql = "SELECT * FROM news WHERE id = :id";
    $stmt = $conn1->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $news = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa dữ liệu</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="d-flex justify-content-center align-items-center vh-100">
        <form class="bg-white p-4 rounded shadow" action="edit.php?id=<?php echo $news['id']; ?>" method="post" enctype="multipart/form-data" style="width: 300px;">
            <div class=" text-center text-primary text-uppercase mb-3" ><strong>Sửa tin tức</strong> </div>
            <div class="mb-3">
                <label for="title" class="form-label fw-bold">Tiêu đề</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $news['title']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label fw-bold">Nội dung</label>
                <input type="text" class="form-control" id="content" name="content" value="<?php echo $news['content']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label fw-bold">Hình ảnh</label>
                <input type="text" class="form-control" id="image" name="image" value="<?php echo $news['image']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label fw-bold">Thể loại</label>
                <input type="text" class="form-control" id="category_id" name="category_id" value="<?php echo $news['category_id']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary w-100" name="btn">Cập nhật</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
