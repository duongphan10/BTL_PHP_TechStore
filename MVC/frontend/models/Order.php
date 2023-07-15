<?php
//models/Order.php
require_once 'models/Model.php';

class Order extends Model {
    public $user_id;
    public $fullname;
    public $address;
    public $mobile;
    public $email;
    public $note;
    public $price_total;
    public $payment_status;

    public function insert() {
        //tạo câu truy vấn
        $sql_insert = "INSERT INTO orders(`user_id`, `fullname`, `address`, `mobile`, `email`, `note`, `price_total`, `payment_status`) VALUE (:user_id, :fullname, :address, :mobile, :email, :note, :price_total, :payment_status)";
        $obj_insert=$this->connection->prepare($sql_insert);
        //tạo mảng để truyền các giá trị thật cho placeholder trong câu truy vấn
        $arr_insert = [
            ':user_id' => $this->user_id,
            ':fullname' => $this->fullname,
            ':address' => $this->address,
            ':mobile' => $this->mobile,
            ':email' => $this->email,
            ':note' => $this->note,
            ':price_total' => $this->price_total,
            ':payment_status' => $this->payment_status,
        ];
        //thực thi truy vấn
        //thông thường khi gọi phương thức execute trên các truy vấn
        //insert, update, delete sẽ trả về true/false
        //tuy nhiên với đặc thù của CSDL hiện tại thì sẽ cần trả về id của chính order vừa insert
        //do có bảng
        $obj_insert->execute($arr_insert);
        $order_id = $this->connection->lastInsertId();
        return $order_id;
    }

    public function getUserOrder() {
        //Lấy used_id
        $user = new User();
        $user = $user->getUser($_SESSION['user']['username']);
        $user_id = $user['id'];
        //tạo câu truy vấn
        $sql_select = "SELECT orders.*, order_details.quality AS soluongmua, products.title AS name, products.price as price 
                        FROM orders 
                        INNER JOIN order_details ON orders.id = order_details.order_id 
                        INNER JOIN products ON order_details.product_id = products.id 
                        WHERE user_id = '$user_id' 
                        ORDER BY id DESC" ;
        $obj_select = $this->connection->prepare($sql_select);
        $obj_select->execute();
        $result = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }


}