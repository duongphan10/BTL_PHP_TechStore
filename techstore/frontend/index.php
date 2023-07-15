<?php
session_start();
date_default_timezone_set("Asia/Ho_Chi_Minh");

//Mô hình MVC
//lấy ra tham số controller và action từ trình duyệt
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

$controller = ucfirst($controller);
$controller .= "Controller"; 
$path_controller = "controllers/$controller.php";

//kiểm tra nếu đường dẫn ko tồn tại, thì báo trang ko tồn tại
if (file_exists($path_controller) == false) {
    die('Trang bạn tìm không tồn tại');
}

require_once "$path_controller";

//khởi tạo đối tượng sau khi nhúng file
$object = new $controller(); //$object = new BookController()

if (method_exists($object, $action) == false) {
    die("Không tồn tại phương thức $action của class $controller");
}

$object->$action();
