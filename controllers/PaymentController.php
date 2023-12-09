<?php
//controllers/PaymentController.php
require_once 'controllers/Controller.php';
require_once 'models/Product.php';
require_once 'models/User.php';
require_once 'models/Order.php';
require_once 'models/OrderDetail.php';
require_once 'models/Slide.php';
require_once 'models/Contact.php';
//nhúng các file liên quan đến thư viện PHPMailer để gửi mail
require_once 'configs/PHPMailer/src/PHPMailer.php';
require_once 'configs/PHPMailer/src/SMTP.php';
require_once 'configs/PHPMailer/src/Exception.php';
//từ khoá use dùng tương tự như require once
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class PaymentController extends Controller
{
    public function index()
    {
        //xử lý submit form khi user click Thanh toán
        if (isset($_POST['submit'])) {
            //gán biến trung gian cho dễ thao tác
            $fullname = $_POST['fullname'];
            $address = $_POST['address'];
            $mobile = $_POST['mobile'];
            $email = $_POST['email'];
            $note = $_POST['note'];

            //phương thức thanh toán
            $method = $_POST['method'];
            if (empty($fullname) || empty($address) || empty($mobile)) {
                $this->error = 'Fullname, address, mobile không đc để trống';
            }
            //chỉ xử lý logic submit form khi ko có lỗi xảy ra
            if (empty($this->error)) {
                //Lấy used_id
                $user = new User();
                $user = $user->getUser($_SESSION['user']['username']);
                $user_id = $user['id'];

                //ko quan tâm đến phương thức thanh toán đang là Trực tuyến
                //hay COD, mà sẽ lưu đơn hàng luôn
                $order_model = new Order();
                $order_model->user_id = $user_id;
                $order_model->fullname = $fullname;
                $order_model->address = $address;
                $order_model->mobile = $mobile;
                $order_model->note = $note;
                $order_model->email = $email;

                
                //tính tổng giá trị đơn hàng cho trường price_total trong bảng order
                $price_total = 0;
                // lặp giỏ hàng, cộng dồn biến $price_total này với giá thành tiền của các sản phẩm tương ứng trong giỏ
                foreach ($_SESSION['cart'] as $cart) {
                    $price_item = $cart['price'] * $cart['quality'];
                    $price_total += $price_item;
                }
                $order_model->price_total = $price_total;
                // trạng thái thanh toán đơn hàng, mặc định ban đầu trạng thái sẽ là chưa thanh toán,
                // trường payment_status trong bảng order đang có kiểu dữ liệu là TINYINT
                $order_model->payment_status = 0;
                $order_id = $order_model->insert();

                //....
                //giả sử đã lưu đơn hàng thành công
                if ($order_id > 0) {
                    //lưu các thông tin vào bảng order_detail
                    // lặp giỏ hàng để lưu thông tin từng phần tử vào bảng
                    $order_detail_model = new OrderDetail();
                    $order_detail_model->order_id = $order_id;
                    foreach ($_SESSION['cart'] as $product_id => $cart) {
                        $order_detail_model->product_id = $product_id;
                        $order_detail_model->quality = $cart['quality'];
                        $is_insert = $order_detail_model->insert();
                        var_dump($is_insert);
                    }

                    //nếu là thanh toán trực tuyến
                    if ($method == 0) {
                        // Xử lý thanh toán trực tuyến
                    }
                    //nếu là thanh toán COD
                    else {
                        
                        foreach ($_SESSION['cart'] as $product_id => $cart) {
                            $quantity = $cart['quality'];
                            $product_model = new Product();
                            // truyền mảng params chứa các chuỗi truy vấn liên quan đến lọc danh mục vầ price nếu có
                            $product_model->updateById($product_id,$quantity);
                        }
                        $this->sendMail($order_model);
                        // unset($_SESSION['cart']);
                        $url_redirect = $_SERVER['SCRIPT_NAME'] . '/cam-on';
                        header("Location: $url_redirect");
                        exit();
                    }
                }
            }
        }
        $slide_model = new Slide();
        $slides = $slide_model->getSlide();
        $slides = null;

        $contact_model = new Contact();
        $contacts = $contact_model->getAll();


        //lấy nội dung view index tương ứng
        $this->content =
            $this->render('views/payments/index.php', [
                'slides' => $slides,
                'contacts' => $contacts
            ]);
        //gọi layout để hiển thị nội dung view vừa lấy đc
        require_once 'views/layouts/main.php';
    }

    public function sendMail($order_model)
    {

        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            //thêm dòng sau để hiển thị đc ký tự có dấu
            $mail->CharSet = 'UTF-8';
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            //sử dụng server gmail để gửi mail
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'techstoregroup7@gmail.com';                     // SMTP username
            $mail->Password   = 'xufhkkksmcfhuwqg';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            //gửi từ ai
            $mail->setFrom('techstoregroup7@gmail.com', 'Gửi từ TechStore');
            //gửi tới ai
            $mail->addAddress($order_model->email);     // Add a recipient          

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Cảm ơn bạn đã đặt hàng!';
            $mail->Body    = "Chào $order_model->fullname,
            <br> 
            Cảm ơn bạn đã đặt các sản phẩm của TechStore. Mong bạn sẽ hài lòng khi sử dụng sản phẩm từ chúng tôi.";
            
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function thank()
    {       

        $slide_model = new Slide();
        $slides = $slide_model->getSlide();
        $slides = null;

        $contact_model = new Contact();
        $contacts = $contact_model->getAll();


        //lấy nội dung view index tương ứng
        $this->content =
            $this->render('views/payments/thank.php', [
                'slides' => $slides,
                'contacts' => $contacts
            ]);
        require_once 'views/layouts/main.php';
        unset($_SESSION['cart']);
    }

}
