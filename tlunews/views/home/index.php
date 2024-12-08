<?php
if(isset($_POST["action"])){
    $action = $_POST["action"];
}
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
                    <li><a type="btn btn-primary" href="index.php?controller=admin&action=login">Đăng nhập</a></li>
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
            <!-- Cột phải: Tin tức -->
            <div class="col-md-9">
    <h1 class="text-success text-center">TIN TỨC MỚI</h1>
    <p class="text-center">Những tin tức mới của ngày hôm nay</p>
    <div class="row">
        <?php if (isset($news) && count($news) > 0): ?>
            <?php foreach ($news as $new): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="<?php echo htmlspecialchars($new->getImage()); ?>" class="card-img-top" alt="Hình ảnh tin tức" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($new->getTitle()); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars(substr($new->getContent(), 0, 100)) . '...'; ?></p>
                        </div>
                        <div class="card-footer text-center">
                        <a href="<?= DOMAIN.'/views/news/detail.php?id='.$new->getId()?>" class="btn btn-primary">Xem Chi Tiết</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">Không có tin tức nào phù hợp!</p>
        <?php endif; ?>
    </div>
</div>
<!-- Phân trang -->
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
    <?php
    for($i = 1 ;$i <= ceil(count($news)/10) ;$i++){
        ?>
         <li class="page-item"><a class="page-link" href="?pages=<?php echo $i;?>"><?php echo $i ?></a></li>
      <?php
      }
      ?>
      <li class="page-item"><a class="page-link" href="#">Next</a></li>
    </ul>
  </nav>
  
  
  
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
  </footer>00:08/-strong/-heart:>:o:-((:-h Xem trước khi gửiThả Files vào đây để xem lại trước khi gửi