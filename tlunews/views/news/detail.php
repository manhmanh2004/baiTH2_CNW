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

    // Truy vấn các bài viết khác
    $sql_other_news = "SELECT * FROM news WHERE id != :id LIMIT 4";
    $stmt_other_news = $conn->prepare($sql_other_news);
    $stmt_other_news->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt_other_news->execute();
    $other_news = $stmt_other_news->fetchAll(PDO::FETCH_ASSOC);

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .news-image {
            height: 300px;
            object-fit: cover;
            width: 100%;
        }

        .content {
            line-height: 1.8;
            font-size: 1.1rem;
            text-align: justify;
        }

        .date-social-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .social-icons ul {
            list-style: none;
            display: flex;
            gap: 15px;
            padding: 0;
            margin: 0;
        }

        .social-icons a {
            text-decoration: none;
            font-size: 1.5rem;
        }

        .social-icons a:hover {
            opacity: 0.8;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
        }

        .other-news img {
            height: 150px;
            object-fit: cover;
            width: 100%;
        }

        .other-news .card-body {
            text-align: center;
        }

        .other-news .card-body h5 {
            font-size: 1.1rem;
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

        <!-- Hiển thị ngày và mạng xã hội -->
        <div class="date-social-container">
            <span class="text-muted border p-2 rounded">
                <?php echo date('l, d F Y'); ?>
            </span>
            <div class="social-icons">
                <ul>
                    <li>
                        <a href="https://facebook.com" target="_blank" title="Facebook">
                            <i class="bi bi-facebook text-primary"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://youtube.com" target="_blank" title="YouTube">
                            <i class="bi bi-youtube text-danger"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://zalo.me" target="_blank" title="Zalo">
                            <i class="bi bi-chat-dots text-info"></i>
                        </a>
                    </li>
                    <li>
                        <a href="mailto:admin@gmail.com" target="_blank" title="Email">
                            <i class="bi bi-envelope text-secondary"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Nội dung chính căn giữa -->
        <div class="row justify-content-center">
            <div class="col-md-6">
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
            </div>
        </div>

        <!-- Các bài viết khác -->
        <div class="mt-5">
            <h3>Các Bài Viết Khác</h3>
            <div class="row">
                <?php foreach ($other_news as $article): ?>
                    <div class="col-md-3">
                        <div class="card other-news">
                            <img src="<?php echo htmlspecialchars($article['image']); ?>" alt="Hình ảnh bài viết khác">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($article['title']); ?></h5>
                                <a href="detail.php?id=<?php echo $article['id']; ?>" class="btn btn-primary">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <p>&copy; 2024 Tin Tức Mới. Tất cả quyền được bảo lưu.</p>
            <p>Địa chỉ: 175 Tây Sơn, Đống Đa, Thanh Xuân, TP. Hà Nội</p>
            <p>
                <a href="mailto:admin@gmail.com" class="text-white">Email: admin@gmail.com</a> |
                <a href="tel:+84123456789" class="text-white">Điện thoại: +84 123 456 789</a>
            </p>
        </div>
        <div class="container">
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#" class="text-white">Thành viên: Đỗ Mạnh Mạnh, Trần Văn Đức, Hoàng Văn Quyết</a></li>
            </ul>
        </div>
    </footer>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
