<?php
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tintuc";

// Lấy id từ URL
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : 0;

try {
    // Tạo kết nối
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Truy vấn chi tiết tin tức
    $sql = "SELECT * FROM news WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $news = $stmt->fetch(PDO::FETCH_ASSOC);

    // Kiểm tra nếu không tìm thấy tin tức
    if (!$news) {
        die("Tin tức không tồn tại!");
    }

} catch (PDOException $e) {
    echo "Lỗi kết nối: " . $e->getMessage();
    die();
}

// Đóng kết nối
$conn = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Tin Tức</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .news-image {
            height: 400px;
            object-fit: cover;
            width: 100%;
        }
        .content {
            line-height: 1.8;
            font-size: 1.1rem;
        }
        .news-footer {
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <!-- Nút Quay lại -->
        <div class="mb-3">
            <a href="index.php" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Quay lại
            </a>
        </div>

        <!-- Nội dung chi tiết -->
        <div class="card">
            <img src="<?php echo htmlspecialchars($news['image']); ?>" alt="Hình ảnh tin tức" class="news-image">
            <div class="card-body">
                <h1 class="card-title text-success"><?php echo htmlspecialchars($news['title']); ?></h1>
                <p class="text-muted">Đăng ngày: <?php echo date('d/m/Y', strtotime($news['created_at'])); ?></p>
                <div class="content">
                    <?php echo nl2br(htmlspecialchars($news['content'])); ?>
                </div>
            </div>
        </div>

        <!-- Footer tin tức -->
        <div class="news-footer">
            <p class="text-muted">Nguồn: <?php echo htmlspecialchars($news['source']); ?></p>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
