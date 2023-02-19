<?php
/**
* Format Class
*/
class Format{
public function formatDate($date){
   return date('F j, Y, g:i a', strtotime($date));
}

public function textShorten($text, $limit = 400){
   $text = $text. " ";
   $text = substr($text, 0, $limit);
   $text = substr($text, 0, strrpos($text, ' '));
   $text = $text.".....";
   return $text;
}

public function validation($data){
   $data = trim($data);
   $data = stripcslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

public function title(){
   $path = $_SERVER['SCRIPT_FILENAME'];
   $title = basename($path, '.php');
   //$title = str_replace('_', ' ', $title);
   if ($title == 'index') {
   $title = 'home';
   }elseif ($title == 'contact') {
   $title = 'contact';
   }
   return $title = ucfirst($title);
   }
}

function currency_format($number, $suffix = 'đ'){
   return number_format($number).$suffix;
}

if (!function_exists('create_slug')) {
function create_slug($string) {
      $search = array(
         '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
         '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
         '#(ì|í|ị|ỉ|ĩ)#',
         '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
         '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
         '#(ỳ|ý|ỵ|ỷ|ỹ)#',
         '#(đ)#',
         '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
         '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
         '#(Ì|Í|Ị|Ỉ|Ĩ)#',
         '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
         '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
         '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
         '#(Đ)#',
         "/[^a-zA-Z0-9\-\_]/",
      );
      $replace = array(
         'a',
         'e',
         'i',
         'o',
         'u',
         'y',
         'd',
         'A',
         'E',
         'I',
         'O',
         'U',
         'Y',
         'D',
         '-',
      );
      $string = preg_replace($search, $replace, $string);
      $string = preg_replace('/(-)+/', '-', $string);
      $string = strtolower($string);
      return $string;
}
}
?>