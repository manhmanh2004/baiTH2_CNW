<?php 
    require_once APP_ROOT.'/models/News.php';
    require_once APP_ROOT.'/models/User.php';
    require_once APP_ROOT.'/services/AdminService.php'; 
    class HomeController{
        public function index(){
            $adminService = new AdminService();
            $news = $adminService->getAllNews();
            include APP_ROOT.'/views/home/index.php';
        }
    }
?>