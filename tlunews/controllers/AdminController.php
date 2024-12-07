<?php 
    require_once APP_ROOT.'/services/AdminService.php';
    class AdminController{
        public function index(){
            $adminService = new AdminService();
            $news = $adminService->getAllNews();

            include APP_ROOT.'/views/admin/news/index.php';
            
        }
    }
?>