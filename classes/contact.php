<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath. '/../lib/database.php');
    include_once ($filepath. '/../helpers/format.php');
?>
<?php
    class contact {
        private $db;
        private $fm;

        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
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
                $alert= "<div class='alert alert-success' role='alert'>Đổi thông tin thành công !</div>" ;
                return $alert;
            }else{
                $alert= "<span class='text-danger text-center'>Thất bại</span>" ;
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
                    $alert = "<div class='alert alert-success' role='alert'>Thêm tài khoản thành công !</div>";
                }else {
                    $alert = "<div class='alert alert-danger' role='alert'>Đăng ký không thành công, vui lòng thử lại !</div>";
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
                $alert= "<span class='text-danger text-center'>Thất bại</span>" ;
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
                $alert= "<span class='text-danger text-center'>lỗi rồi</span>";
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
                $alert= "<div class='alert alert-success' role='alert'>Thêm thành công !</div></span>" ;
                return $alert;
            }else{
                $alert= "<span class='text-danger text-center'>Thất bại</span>" ;
                return $alert;
            }
        }
    }
?>