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

    // Lấy danh sách thể loại
    $sqlCategories = "SELECT id, name FROM categorys"; 
    $categoryStmt = $conn->prepare($sqlCategories);
    $categoryStmt->execute();
    $categories = $categoryStmt->fetchAll(PDO::FETCH_ASSOC);

    // Kiểm tra xem có từ khóa tìm kiếm hay không
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
    
    // Phân trang
    $recordsPerPage = 9;
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $recordsPerPage;

    // Sửa câu truy vấn tìm kiếm
    if ($searchTerm) {
        $sqlTotal = "SELECT COUNT(*) AS total FROM news WHERE title LIKE :searchTerm OR content LIKE :searchTerm";
        $sql = "SELECT * FROM news WHERE title LIKE :searchTerm OR content LIKE :searchTerm LIMIT :limit OFFSET :offset";
    } else {
        $sqlTotal = "SELECT COUNT(*) AS total FROM news";
        $sql = "SELECT * FROM news LIMIT :limit OFFSET :offset";
    }

    // Lấy tổng số bản ghi
    $totalStmt = $conn->prepare($sqlTotal);
    if ($searchTerm) {
        $searchTerm = "%" . $searchTerm . "%";
        $totalStmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
    }
    $totalStmt->execute();
    $totalResult = $totalStmt->fetch(PDO::FETCH_ASSOC);
    $totalRecords = $totalResult['total'];  
    $totalPages = ceil($totalRecords / $recordsPerPage);

    // Lấy tin tức
    $stmt = $conn->prepare($sql);
    if ($searchTerm) {
        $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
    }
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

    <style>
        /* Căn chỉnh phần ngày và mạng xã hội */
        .date-social-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Biểu tượng mạng xã hội ngang */
        .social-icons ul {
            display: flex;
            justify-content: flex-end;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .social-icons ul li {
            margin-right: 15px;
        }

        .social-icons ul li:last-child {
            margin-right: 0;
        }

        /* Tùy chỉnh icon */
        .social-icons a {
            text-decoration: none;
            font-size: 20px;
        }

        .social-icons a:hover {
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <div class="container mt-3">
        <!-- Hàng ngày và biểu tượng mạng xã hội -->
        <div class="row mb-3 date-social-container">
            <div>
                <span class="text-muted border p-2 rounded">
                    <?php 
                        // Hiển thị ngày hiện tại
                        echo date('l, d F Y'); 
                    ?>
                </span>
            </div>

            <!-- Các biểu tượng mạng xã hội -->
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


        <!-- Form tìm kiếm -->
        <div class="mb-4">
            <form method="GET" action="">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Tìm kiếm tin tức..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <button class="btn btn-outline-secondary" type="submit">Tìm</button>
                </div>
            </form>
        </div>

        <!-- Bố cục chia 2 cột -->
        <div class="row">
            <!-- Cột trái: Thể loại -->
            <div class="col-md-2">
                <div class="bg-light p-3 rounded">
                    <h5 class="text-center text-success">Thể Loại</h5>
                    <ul class="list-group">
                        <?php foreach ($categories as $category): ?>
                            <li class="list-group-item">
                                <a href="#" class="text-decoration-none"><?php echo htmlspecialchars($category['name']); ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <!-- Cột phải: Tin tức -->
            <div class="col-md-9">
                <h1 class="text-success text-center">TIN TỨC MỚI</h1>
                <p class="text-center">Những tin tức mới của ngày hôm nay</p>

                <div class="row">
                    <?php if (count($tinbaos) > 0): ?>
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
                    <?php else: ?>
                        <p class="text-center">Không có tin tức nào phù hợp!</p>
                    <?php endif; ?>
                </div>

                <!-- Phân trang -->
                <div class="d-flex justify-content-center mt-4">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <!-- Nút 'Trước' -->
                            <?php if ($page > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $page - 1; ?>&search=<?php echo htmlspecialchars($searchTerm); ?>">Trước</a>
                                </li>
                            <?php endif; ?>

                            <!-- Các trang -->
                            <?php for ($i = max(1, $page - 2); $i <= min($totalPages, $page + 2); $i++): ?>
                                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                    <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo htmlspecialchars($searchTerm); ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>

                            <!-- Nút 'Sau' -->
                            <?php if ($page < $totalPages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $page + 1; ?>&search=<?php echo htmlspecialchars($searchTerm); ?>">Sau</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
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
