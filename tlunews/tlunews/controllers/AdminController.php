<?php 
    require_once APP_ROOT.'/services/AdminService.php';
    class AdminController{
        public function index(){
            $adminService = new AdminService();
            $news = $adminService->getAllNews();
            include APP_ROOT.'/views/admin/news/index.php';
            
        }
        public function login(){
        $admin = new AdminService();
        $user = $admin->getAdminusers();
        include APP_ROOT.'/views/admin/login.php';
        }
        public function dashboard(){
           include APP_ROOT.'/views/admin/dashboard.php';
        }
    }
?>