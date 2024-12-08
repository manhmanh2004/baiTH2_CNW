<?php 
    require_once APP_ROOT.'/services/AdminService.php';
    class HomeController{
        public function index(){
            $adminService = new AdminService();
           
            $categories = $adminService->getAllCategorys();
             $news = $adminService->getAllNews();
            include APP_ROOT.'/views/home/index.php';
        }
    }
?>