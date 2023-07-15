<!-- User.php -->
<?php
	require_once 'models/Model.php';
	class User extends Model {
		// khai báo các thuộc tính của class dựa vào trường trong bảng user
		public $username;
		public $password;
		public $role;
		public $first_name;
		public $last_name;
		public $phone;
		public $address;
		public $email;
		public $created_at;
    	public $updated_at;
		public function getUser($username) {
			$sql_select_once = "SELECT * FROM users WHERE `username` = :username";
			$obj_select_one = $this->connection->prepare($sql_select_once);
			$arr_select = [
				':username' => $username
			];
			$obj_select_one->execute($arr_select);
			$user = $obj_select_one->fetch(PDO::FETCH_ASSOC);
			return $user;
		}
		public function getAll() {
			$sql_select_all = "SELECT * FROM users";
			$obj_select_all = $this->connection->prepare($sql_select_all);
		
			$obj_select_all->execute();
			$users = $obj_select_all->fetchAll(PDO::FETCH_ASSOC);
			return $users;
		}

		//Đăng ký user
		public function register() {
			$sql_insert = "INSERT INTO users (`username`, `password`,`role`,`first_name`, `last_name`, `phone`, `address`, `email`) 
					VALUES(:username, :password, :role, :first_name, :last_name, :phone, :address, :email)";
			$obj_insert = $this->connection->prepare($sql_insert);
			//gán giá trị thật cho các placeholder
			$arr_insert = [
				':username' => $this->username,
				':password' => $this->password,
				':role' => $this->role,
				':first_name' => $this->first_name,
				':last_name' => $this->last_name,
				':phone' => $this->phone,
				':address' => $this->address,
				':email' => $this->email
			];
			return $obj_insert->execute($arr_insert);
		}

		public function getUserLogin($username, $password) {
			$sql_select_one = "SELECT * FROM users WHERE `username` = :username AND `password` = :password";
			$obj_select_one = $this->connection->prepare($sql_select_one);
			// truyền giá trị thật cho các placeholder trong câu truy vấn
			$arr_select = [
				':username' => $username,
				':password' => $password
			];
			//thực thi truy vấn
			$obj_select_one->execute($arr_select);
			$user = $obj_select_one->fetch(PDO::FETCH_ASSOC);
			return $user;
		}
		public function delete($id)    	{
			$obj_delete = $this->connection
				->prepare("DELETE FROM users WHERE id = $id");
			return $obj_delete->execute();
		}
	} 
 ?>