<?php
    
    require_once('config/config.php');
    require_once APP_ROOT.'/libs/DBConnection.php';
    // require_once APP_ROOT.'/controllers/AdminController.php';
    // $adminController = new AdminController();
    // $adminController->index() ;

    $controller = isset($_GET['controller']) ? $_GET['controller'] :'home';
    $action = isset($_GET['action']) ? $_GET['action']:'index';
    if ($controller == 'admin' && $action == 'login') 
    {
        require_once APP_ROOT.'/controllers/AdminController.php';
        $adminController = new AdminController();
        $adminController->login() ;
    }
    else if ($controller == 'admin'&& $action == 'add')
    {
        require_once APP_ROOT.'/controllers/AdminController.php';
        $adminController = new AdminController();
        $adminController->add() ;
    }
    else if ($controller == 'admin'&& $action == 'dashboards')
    {
        require_once APP_ROOT.'/controllers/AdminController.php';
        $adminController = new AdminController();
        $adminController->dashboards() ;
    }
    else if ($controller == 'admin'&& $action == 'edit')
    {
        require_once APP_ROOT.'/controllers/AdminController.php';
        $adminController = new AdminController();
        $adminController->edit() ;
    }
    else if ($controller == 'home'&& $action == 'index')
    {
        require_once APP_ROOT.'/controllers/HomeController.php';
        $homeController = new HomeController();
        $homeController->index() ;
    }
    
?>

