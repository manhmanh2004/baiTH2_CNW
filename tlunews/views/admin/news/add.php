<?php 
    // include("");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Centered</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="d-flex justify-content-center align-items-center vh-100">
        <form class="bg-white p-4 rounded shadow" action="add_new" method="get" enctype="multipart/form-data" style="width: 300px;">
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
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
