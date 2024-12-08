<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }
        .logout-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #f44336;
            color: white;
            border: none;
            cursor: pointer;
        }
        .logout-btn:hover {
            background-color: #d32f2f;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Welcome to the Dashboard</h1>
        <p>Hello, <?php echo htmlspecialchars($username); ?>!</p>
        <p>This is your personal dashboard. You can access your account details, manage settings, or view analytics here.</p>
        
        <h3 class = 'text-center text-uppercase text-success my-3'>Quản lý tin tức</h3>
        <a href="<?= DOMAIN.'views/admin/news/add.php'?>" class = 'btn btn-success'>Thêm mới</a>
        <form method="post">
            <button type="submit" class="logout-btn">Logout</button>
        </form>
        <table class="table">
  <thead>
    <tr>
      <th scope="col">Số thứ tự</th>
      <th scope="col">Tiêu đề</th>
      <th scope="col">Nội dung</th>
      <th scope="col">Hình ảnh</th>
      <th scope="col">Ngày tạo</th>
      <th scope="col">Loại</th>
      <th scope="col">Sửa</th>
      <th scope="col">Xóa</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($news as $new){ ?>
    <tr>
      <th scope="row"><?= $new->getID();?></th>
      <td><?= $new->getTitle();?></td>
      <td><?= $new->getContent();?></td>
      <td><img src="<?= $new->getImage();?>" alt=""></td>
      <td><?= $new->getCreatedAt();?></td>
      <td><?= $new->getCategoryId();?></td>
      <td><a href="<?= DOMAIN.'views/admin/news/edit.php?id='.$new->getId()?>"><i class="bi bi-pen"></i></a></td>
      <td><a href="<?= DOMAIN.'views/admin/news/delete.php?id='.$new->getId()?>"><i class="bi bi-pen"></i></a></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>