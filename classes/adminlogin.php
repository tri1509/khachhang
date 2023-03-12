<?php
    $filepath = realpath(dirname(__FILE__));
    include ($filepath. '/../lib/session.php');
    Session::checkLogin();
    include_once ($filepath. '/../lib/database.php');
    include_once ($filepath. '/../helpers/format.php');
?>
<?php
    class adminlogin {
        private $db;
        private $fm;
        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function login($code,$pass){
            $code = $this->fm->validation($code);
            $pass = $this->fm->validation($pass);
            $code = mysqli_real_escape_string($this->db->link,$code);
            $pass = mysqli_real_escape_string($this->db->link,$pass);
            if(empty($code) || empty($pass)) {
                $alert = sweet_error("Không được để trống !");
                return $alert;
            }else{
                $query = "SELECT * FROM admin WHERE code = '$code' AND pass = '$pass' LIMIT 1";
                $result = $this->db->select($query);
                if($result) {
                    $value = $result->fetch_assoc();
                    Session::set('adminlogin',true);
                    Session::set('adminId',$value['id']);
                    Session::set('adminName',$value['name']);
                    Session::set('adminCode',$value['code']);
                    header('location:index.php');
                }else {
                    $alert = sweet_error("Tài khoản hoặc mật khẩu không đúng !");
                }
                return $alert;
            }
        }

        public function register($data){
            $code = mysqli_real_escape_string($this->db->link, $data['code']);
            $name = mysqli_real_escape_string($this->db->link, $data['name']);
            $room = mysqli_real_escape_string($this->db->link, $data['room']);
            $pass = mysqli_real_escape_string($this->db->link, $data['pass']);
            $check_code = "SELECT * FROM admin WHERE code='$code' LIMIT 1";
            $result_check = $this->db->select($check_code);
            if($result_check){
                $alert = "<span class='caption mb-4 text-info'>Mã số này đã được đăng ký rồi, mời bạn dùng mã số khác !</span>";
                return $alert;
            }else{
                $query = "INSERT INTO admin(pass,code,name,room) VALUE('$pass','$code','$name','$room')";
                $result = $this->db->insert($query);
                if($result) {
                    $alert = "<p class='caption mb-4 text-success'>Đăng ký thành công ! Mời bạn <a href='dang-nhap'>Đăng nhập</a> </p>";
                }else {
                    $alert = "<p class='caption mb-4 text-danger'>Đăng ký không thành công, vui lòng thử lại !</p>";
                }
                return $alert;
            }

        }
    }
?>