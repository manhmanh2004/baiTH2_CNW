<?php
require_once APP_ROOT . '/services/NewsService.php';

class NewsController {
    public function detail($id) {
        // Logic để lấy chi tiết tin tức từ Model
        $adminService = new AdminService();
        $new = $adminService->getNew($id); // Lấy thông tin tin tức theo ID
        include APP_ROOT . '/views/news/detail.php'; // Gửi dữ liệu đến view
    }
}
?>
