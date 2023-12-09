<!-- LoginController.phps -->
<?php
	//xử lý đăng nhập đăng ký cho user
	require_once 'controllers/Controller.php';
	require_once 'models/User.php';
require_once 'models/Slide.php';
require_once 'models/Contact.php';
require_once 'models/Order.php';
	class LoginController extends Controller {

		//xử lý đăng ký user
		public function signup() {
			if (isset($_POST['submit'])) {
				//tạo biến và gán giá trị từ form cho biến
				$username = $_POST['username'];
				$password = $_POST['password'];
				$first_name = $_POST['first_name'];
				$last_name= $_POST['last_name'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];
                $email = $_POST['email'];

				//validate form
				if (empty($username) || empty($password)) {
					$this->error = 'Username hoặc password không được để trống!';
				}

				//xử lý đăng ký user trong trường hợp k có lỗi validate				
            	if (empty($this->error)) {
	                //can kiem tra Th username da ton tai trong csdl thi bao loi
	                $user_model = new User();
	                //lay thong tin user dua vao username
	                $user = $user_model->getUser($username);
	                //trường hợp username đã tồn tại
	                if (!empty($user)) {
	                	$this->error = 'Username đã tồn tại!';
	                }else {
	                	//gán các giá trị cho thuộc tính tương ứng của model
	                	$user_model->username = $username;
	                	
	                	//mã hoá password 
	                	$user_model->password = md5($password);
                        $user_model->first_name = $first_name;
                        $user_model->last_name = $last_name;
                        $user_model->phone = $phone;
                        $user_model->address = $address;
                        $user_model->email = $email;
	                	$is_register = $user_model->register();
	                	if($is_register){
	                		$_SESSION['success'] = 'Đăng ký thành công!';
	                	}else {
	                		$_SESSION['error'] = 'Đăng ký thất bại!';
	                	}
	                	header('Location: index.php?controller=login&action=login');
	                	exit();
	                }
            	}
			}
            $slide_model = new Slide();
            $slides = $slide_model->getSlide();
			$slides = null;

            $contact_model = new Contact();
            $contacts = $contact_model->getAll();
			//lấy nội dung view tương ứng
			$this->content = $this->render('views/users/signup.php', [
                'slides' => $slides,
                'contacts' => $contacts
            ]);
			//gọi layout tương ứng
			require_once 'views/layouts/main.php';
		}
		//xử lý login
		public function login() {
			if (isset($_POST['submit'])) {
				//gán biến 
				$username = $_POST['username'];
				$password = $_POST['password'];
				
				if (empty($username) || empty($password)) {
					$this->error = 'Không được để trống trường username hoặc password';
				}
				//xử lý login submit form chỉ khi nào không có lỗi validate
				if (empty($this->error)) {
					// xử lý login thì thường sẽ tạo ra 1 session chứa thông tin của user tìm được
					$user_model = new User();
					// do password lưu trong CSDL đang được mã hoá theo cơ chế md5
					$password = md5($password);
					//gọi phương thức lấy user từ csdl
					//dựa vào username và password đã mã hoá
					$user = $user_model->getUserLogin($username, $password);
					if (empty($user)) {
						$this->error = 'Sai tài khoản hoặc mật khẩu!';
					}else {
						if ($user['role'] == 1) {
							$this->success = 'Đăng nhập thành công';
							$_SESSION['user'] = $user;
							
							echo '<script>';
							echo 'var result = window.confirm("Đến trang quản lý?");';
							echo 'if (result) {';
							echo '    window.location.href = "backend/index.php";';
							echo '} else {';
							echo '    window.location.href = "index.php";';
							echo '}';
							echo '</script>';
							
							exit();
						} else {
							$this->success = 'Đăng nhập thành công';
							$_SESSION['user'] = $user;
							
							// Chuyển hướng tới trang người dùng bình thường
							header('Location: index.php');
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

			//lấy nội dung view login
			$this->content = $this->render('views/users/login.php', [
                'slides' => $slides,
                'contacts' => $contacts
            ]);
			//gọi layout để hiển thị view
			require_once 'views/layouts/main.php';
		}
		//đăng xuất người dùng khỏi hệ thống
		public function logout() {
		    if (empty($_SESSION['user'])){
                $_SESSION['error'] = 'Bạn chưa đăng nhập!';
                header('Location: index.php?controller=login&action=login');
                exit();
            }else{
			//xoá tất cả các session liên quan đến user đã đăng nhập
			unset($_SESSION['user']);
			unset($_SESSION['cart']);
			//xoá tất cả các session khác trên hệ thống
			$_SESSION['success'] = 'Đăng xuất thành công!';
			//chuyển hướng về trang login
			header('Location: index.php?controller=login&action=login');
			exit();
            }
		}

		//thong tin nguoi dung
		public function info() {
			if (isset($_POST['edit'])) {
				//lấy giá trị từ form cho biến
				$username = $_POST['username'];
				$password = $_POST['password'];
				$new_password = $_POST['new_password'];
				$first_name = $_POST['first_name'];
				$last_name= $_POST['last_name'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];
                $email = $_POST['email'];

				//validate form
				//không được để trống các trường username và password, trường password và confirm password phải giống nhau
				if (md5($password) != $_SESSION['user']['password']) {
					$this->error = 'Mật khẩu cũ không chính xác!';
				}

				//xử lý đăng ký user trong trường hợp k có lỗi validate				
            	if (empty($this->error)) {
	                //can kiem tra Th username da ton tai trong csdl thi bao loi
	                $user_model = new User();
	                
					//gán các giá trị cho thuộc tính tương ứng của model
					$user_model->username = $username;
					$user_model->password = md5($new_password);
					$user_model->first_name = $first_name;
					$user_model->last_name = $last_name;
					$user_model->phone = $phone;
					$user_model->address = $address;
					$user_model->email = $email;
					$user_update = $user_model->updateUser();
					if($user_update){
						//xoá tất cả các session liên quan đến user đã đăng nhập
						unset($_SESSION['user']);
						$_SESSION['success'] = 'Cập nhật thành công!';
					}else {
						$_SESSION['error'] = 'Cập nhật thất bại!';
					}
					header('Location: index.php?controller=login&action=login');
					exit();
            	}
			}
			
            $slide_model = new Slide();
            $slides = $slide_model->getSlide();
			$slides = null;
			
            $contact_model = new Contact();
            $contacts = $contact_model->getAll();

			//lấy nội dung view info
			$this->content = $this->render('views/users/info.php', [
                'slides' => $slides,
                'contacts' => $contacts
            ]);
			//gọi layout để hiển thị view
			require_once 'views/layouts/main.php';
		}


		public function order() {
			$order_model= new Order();
			$ordes = $order_model->getUserOrder();
			
            $slide_model = new Slide();
            $slides = $slide_model->getSlide();
			$slides = null;
			
            $contact_model = new Contact();
            $contacts = $contact_model->getAll();

			//lấy nội dung view order
			$this->content = $this->render('views/users/show_order.php', [
				'orders' => $ordes,
                'slides' => $slides,
                'contacts' => $contacts,
				
            ]);
			//gọi layout để hiển thị view
			require_once 'views/layouts/main.php';
		}

	} 
 ?>