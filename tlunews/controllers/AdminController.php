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
            $adminService = new AdminService();
            $news = $adminService->getAllNews();
            require APP_ROOT.'/views/admin/login.php';
            }
            public function dashboard(){
                require APP_ROOT.'/views/admin/dashboard.php';
            }
        public function add(){
    
                include APP_ROOT.'/views/admin/news/add.php';
                
            }
        public function dashboards(){
            $adminService = new AdminService();
            $news = $adminService->getAllNews();
            require APP_ROOT.'/views/admin/dashboard.php';
            }
        public function edit(){
            include APP_ROOT.'/views/admin/news/edit.php';
        }
    }
?>