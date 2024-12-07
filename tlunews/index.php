<?php

// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tintuc";

// Lấy ngày hiện tại
$date = date('l, d F Y');

try {
    // Tạo kết nối
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Phân trang
    $recordsPerPage = 9;
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;  
    $offset = ($page - 1) * $recordsPerPage;

    // Lấy tổng số bản ghi
    $sqlTotal = "SELECT COUNT(*) AS total FROM news";
    $totalStmt = $conn->prepare($sqlTotal);
    $totalStmt->execute();
    $totalResult = $totalStmt->fetch(PDO::FETCH_ASSOC);
    $totalRecords = $totalResult['total'];  
    $totalPages = ceil($totalRecords / $recordsPerPage);

    // Lấy tin tức
    $sql = "SELECT * FROM news LIMIT :limit OFFSET :offset";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':limit', $recordsPerPage, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $tinbaos = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <title>Tin tức</title>
    <!-- Sử dụng Bootstrap qua CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container mt-5">
        <!-- Header với ngày hiện tại và khung -->
        <div class="row mb-3">
            <div class="col-md-12 text-start">
                <!-- Thêm khung cho ngày -->
                <span class="text-muted border p-2 rounded"><?php echo $date; ?></span>
            </div>
        </div>

        <h1 class="text-success text-center">TIN TỨC MỚI</h1>
        <p class="text-center">Những tin tức mới của ngày hôm nay</p>

        <!-- Thanh tìm kiếm dưới TIN TỨC MỚI -->
        <div class="text-center mb-4">
            <form action="" method="get">
                <input type="text" name="search" class="form-control w-50 mx-auto" placeholder="Tìm kiếm tin tức..."
                    value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button type="submit" class="btn btn-primary mt-2">Tìm kiếm</button>
            </form>
        </div>

        <div class="row">
            <?php foreach ($tinbaos as $tinbao): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="<?php echo htmlspecialchars($tinbao['image']); ?>" class="card-img-top" alt="Hình ảnh tin tức" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($tinbao['title']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars(substr($tinbao['content'], 0, 100)) . '...'; ?></p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="detail.php?id=<?php echo $tinbao['id']; ?>" class="btn btn-primary">Xem Chi Tiết</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Phân trang -->
        <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <!-- Nút 'Trước' -->
                    <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $page - 1; ?>">Trước</a>
                        </li>
                    <?php endif; ?>

                    <!-- Các trang -->
                    <?php for ($i = max(1, $page - 2); $i <= min($totalPages, $page + 2); $i++): ?>
                        <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <!-- Nút 'Sau' -->
                    <?php if ($page < $totalPages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $page + 1; ?>">Sau</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>

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
            <li class="list-inline-item"><a href="#" class="text-white">Thành viên: Đỗ Mạnh Mạnh , Trần Văn Đức , Hoàng Văn Quyết</a></li>
        </ul>
    </div>
</footer>
