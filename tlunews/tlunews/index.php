<?php
    
    require_once('config/config.php');
    require_once APP_ROOT.'/libs/DBConnection.php';
    require_once 'models/News.php';
    require_once 'controllers/HomeController.php';
    // require_once APP_ROOT.'/controllers/AdminController.php';
    // $adminController = new AdminController();
    // $adminController->index() ;

    // $controller = isset($_GET['controller']) ? $_GET['controller'] :'admin';
    // $action = isset($_GET['action']) ? $_GET['action']:'index';
    // if ($controller == 'admin')
    // {
    //     require_once APP_ROOT.'/controllers/AdminController.php';
    //     $adminController = new AdminController();
    //     $adminController->login() ;
    // }
    // else if ($controller == 'home')
    // {
    //     require_once APP_ROOT.'/controllers/HomeController.php';
    //     $homeController = new HomeController();
    //     $homeController->index() ;
    // }
    $controller = isset($_GET['controller']) ? $_GET['controller'] :'home';
    $action = isset($_GET['action']) ? $_GET['action']:'index';
    if ($controller == 'home')
    {
            require_once APP_ROOT.'/controllers/HomeController.php';
            $homeController = new HomeController();
            $homeController->index() ;
    }
    else if($action== 'login')
    {
            require_once APP_ROOT.'/controllers/AdminController.php';
            $homeController = new AdminController();
            $homeController-> login();
    }
    else if ($action== 'dashboard')
    {
            require_once APP_ROOT.'/controllers/HomeController.php';
            $homeController = new HomeController();
            $homeController->index() ;
    }
?>