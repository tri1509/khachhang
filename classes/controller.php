<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath. '/../lib/database.php');
    include_once ($filepath. '/../helpers/format.php');
?>
<?php
    function alert_danger($alert){
        $alert_danger = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>$alert<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div></div>";
        return $alert_danger ;
    }
    function alert_success($alert){
        $alert_success = "<div class='alert alert-success alert-dismissible fade show' role='alert'>$alert<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div></div>";
        return $alert_success ;
    }
    function sweetalert2($alert){
        $alert_success ="<script>Swal.fire('$alert','Bấm OK để xác nhận !','success')</script>";
        return $alert_success;
    }
    function Return_Confirm($alert){
        $alert_confirm ="<script>Swal.fire('$alert','Bấm OK để xác nhận !','success')</script>";
        return $alert_confirm;
    }

    class contact {
        private $db;
        private $fm;

        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function del_user($id) {
            $query = "DELETE FROM admin WHERE id = '$id'";
            $result = $this->db->delete($query);
            if($result){
                header('location:list-user.php');
            }else{
                $alert= alert_danger("Lỗi thao tác !");
                return $alert;
            }
        }
        public function edit_pass($data,$code_md5) {
            $pass = mysqli_real_escape_string($this->db->link, $data['pass']);
            $new_pass = mysqli_real_escape_string($this->db->link, $data['new_pass']);
            $code_md5 = mysqli_real_escape_string($this->db->link,$code_md5);
            $check_pass = "SELECT * FROM admin WHERE md5(code) = '$code_md5' LIMIT 1";
            $result_check_pass = $this->db->select($check_pass);
            $result = $result_check_pass -> fetch_assoc();
            $get_pass = $result['pass'];
            if($pass == $get_pass){
                if($new_pass == "") {
                    $alert = alert_danger("Không được để trống mật khẩu mới !");
                    return $alert;
                }else{
                    $pattern = '/^[A-Za-z0-9_\.!@#$%^&*()]{6,32}$/';
                    if(!preg_match($pattern,$new_pass)){
                        $alert = alert_danger("Đặt mật khẩu phức tạp hơn !!!");
                        return $alert;
                    }else{
                        $md5_new_pass = md5($new_pass);
                        $query = "UPDATE admin SET pass = '$md5_new_pass' WHERE md5(code) = '$code_md5'";
                        $result = $this->db->update($query);
                        if($result){
                            $alert= alert_success("Đổi mật khẩu thành công !") ;
                            return $alert;
                        }else{
                            $alert= alert_danger("Lỗi thao tác !!!") ;
                            return $alert;
                        }
                    }
                }
            }else{
                $alert = alert_danger("Mật khẩu cũ chưa đúng !!!");
                return $alert;
            }
        }
        public function edit_user($data,$code_md5) {
            $code = mysqli_real_escape_string($this->db->link, $data['code']);
            $name = mysqli_real_escape_string($this->db->link, $data['name']);
            $room = mysqli_real_escape_string($this->db->link, $data['room']);
            $query = "UPDATE admin SET 
                name = '$name',
                code = '$code',
                room = '$room'
                WHERE md5(code) = '$code_md5'";
            $result = $this->db->update($query);
            if($result){
                $alert= alert_success("Đổi thông tin thành công &#x2713") ;
                return $alert;
            }else{
                $alert= alert_danger("Lỗi thao tác !") ;
                return $alert;
            }
        }
        public function get_user($code_md5){
            $code_md5 = mysqli_real_escape_string($this->db->link,$code_md5);
            $query = "SELECT * FROM admin WHERE md5(code) = '$code_md5' LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        public function show_user(){
            $query = "SELECT * FROM admin ORDER BY id ASC";
            $result = $this->db->select($query);
            return $result;
        }
        public function add_user($data){
            $code = mysqli_real_escape_string($this->db->link, $data['code']);
            $name = mysqli_real_escape_string($this->db->link, $data['name']);
            $room = mysqli_real_escape_string($this->db->link, $data['room']);
            $pass = mysqli_real_escape_string($this->db->link, $data['pass']);
            $check_code = "SELECT * FROM admin WHERE code='$code' LIMIT 1";
            $result_check = $this->db->select($check_code);
            if($result_check){
                $get_resule = $result_check -> fetch_assoc();
                $alert = "<div class='alert alert-info' role='alert'>Mã số này đã được ";
                $alert .= $get_resule['name'];
                $alert .= " đăng ký rồi, mời bạn dùng mã số khác !</div>";
                return $alert;
            }else{
                $query = "INSERT INTO admin(pass,code,name,room) VALUE('$pass','$code','$name','$room')";
                $result = $this->db->insert($query);
                if($result) {
                    $alert = sweetalert2("Thêm tài khoản thành công &#x2713") ;
                }else {
                    $alert = alert_danger("Đăng ký không thành công, vui lòng thử lại !");
                }
                return $alert;
            }

        }
        public function update($data,$files,$code,$id) {
            $code = mysqli_real_escape_string($this->db->link, $code);
            $name = mysqli_real_escape_string($this->db->link, $data['name']);
            $area = mysqli_real_escape_string($this->db->link,$data['area']);
            $job = mysqli_real_escape_string($this->db->link,$data['job']);
            $question = mysqli_real_escape_string($this->db->link,$data['question']);
            $search = mysqli_real_escape_string($this->db->link,$data['search']);
            $phone = mysqli_real_escape_string($this->db->link,$data['phone']);
            $note = mysqli_real_escape_string($this->db->link,$data['note']);
            $time = mysqli_real_escape_string($this->db->link,$data['time']);
            $query = "UPDATE nguon SET 
                name = '$name',
                code = '$code',
                area = '$area',
                job = '$job',
                question = '$question',
                search = '$search',
                phone = '$phone',
                phone = '$phone',
                note = '$note',
                time = '$time'
                WHERE id = '$id' AND code = '$code' ";
            $result = $this->db->update($query);
            if($result){
                header('location:list-contact.php');
            }else{
                $alert= alert_danger("Lỗi thao tác !") ;
                return $alert;
            }
        }
        public function get_id($id,$code){
            $id = mysqli_real_escape_string($this->db->link,$id);
            $code = mysqli_real_escape_string($this->db->link,$code);
            $query = "SELECT * FROM nguon WHERE id = '$id' AND code = '$code' LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        public function del($id,$code) {
            $query = "DELETE FROM nguon WHERE id = '$id' AND code ='$code'";
            $result = $this->db->delete($query);
            if($result){
                header('location:list-contact.php');
            }else{
                $alert= alert_danger("Lỗi thao tác !");
                return $alert;
            }
        }
        public function show($code){
            $query = "SELECT * FROM nguon WHERE code = '$code' ORDER BY id DESC";
            $result = $this->db->select($query);
            return $result;
        }
        public function insert($data,$files,$code){
            $code = mysqli_real_escape_string($this->db->link, $code);
            $name = mysqli_real_escape_string($this->db->link, $data['name']);
            $area = mysqli_real_escape_string($this->db->link,$data['area']);
            $job = mysqli_real_escape_string($this->db->link,$data['job']);
            $question = mysqli_real_escape_string($this->db->link,$data['question']);
            $search = mysqli_real_escape_string($this->db->link,$data['search']);
            $phone = mysqli_real_escape_string($this->db->link,$data['phone']);
            $note = mysqli_real_escape_string($this->db->link,$data['note']);
            $query = "INSERT INTO nguon(name,code,job,phone,area,search,question,note) VALUES('$name','$code','$job','$phone','$area','$search','$question','$note')";
            $result = $this->db->insert($query);
            if($result){
                // $alert= alert_success("Thêm thành công &#x2713") ;
                $alert= sweetalert2("Thêm thành công &#x2713") ;
                return $alert;
            }else{
                $alert= alert_danger("Lỗi thao tác !") ;
                return $alert;
            }
        }
    }
?>