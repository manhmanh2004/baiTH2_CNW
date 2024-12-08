<?php
    
    require_once('config/config.php');
    require_once APP_ROOT.'/libs/DBConnection.php';
    // require_once APP_ROOT.'/controllers/AdminController.php';
    // $adminController = new AdminController();
    // $adminController->index() ;

    $controller = isset($_GET['controller']) ? $_GET['controller'] :'admin';
    $action = isset($_GET['action']) ? $_GET['action']:'login';
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
    // else if ($controller == 'home')
    // {
    //     require_once APP_ROOT.'/controllers/HomeController.php';
    //     $homeController = new HomeController();
    //     $homeController->index() ;
    // }
    // $controller = isset($_GET['controller']) ? $_GET['controller'] :'home';
    // $action = isset($_GET['action']) ? $_GET['action']:'index';
    // if ($controller == 'home')
    // {
    //     require_once APP_ROOT.'/views/home/index.php';
        
    // }
    // $controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
    // $action = isset($_GET['action']) ? $_GET['action'] : 'index';
    // $id = isset($_GET['id']) ? $_GET['id'] : null;
    // switch ($controller) {
    //     case 'admin':
    //         require_once 'Controller/AdminController.php';
    //         $controllerObj = new AdminController();
    //         if ($action == 'view' && $id) {
    //             $controllerObj->view($id);
    //         } else {
    //             $controllerObj->index();
    //         }
    //         break;
    //     case 'news':
    //         require_once 'Controller/NewsController.php';
    //         $controllerObj = new NewsController();
    //         // Gọi phương thức tương ứng
    //         if ($action == 'view' && $id) {
    //             $controllerObj->view($id);
    //         } else {
    //             $controllerObj->index();
    //         }
    //         break;
    //     case 'home':
    //     default:
    //         require_once 'Controller/HomeController.php';
    //         $controllerObj = new HomeController();
    //         $controllerObj->index();
    //         break;
    // }
?>

