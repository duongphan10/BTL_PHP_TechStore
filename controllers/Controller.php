<?php
class Controller {
    //chứa thông tin về lỗi validate của form
    public $error;
    //chứa thông tin của nội dung view theo từng chức năng
    public $content;

    //phương thức dùng để lấy nội dung view động
    //$file: đường dẫn tới file view
    //$variales: mảng các phần tử, chính là các biến sẽ
    //sử dụng ở trong view
    public function render($file, $variables = []) {
        extract($variables);
        //mở vùng đệm để ghi nhớ nội dung view
        ob_start();
        //nhúng đường dẫn file view
        require_once $file;
        //kết thúc việc ghi nội dung file
        $view = ob_get_clean();
        return $view;
    }
}