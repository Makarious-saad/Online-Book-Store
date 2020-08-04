<?php
// Start SESSION
@ob_start();
@session_start();
// Display Errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

trait connDatabase{
  public function connDatabase(){
    @include_once("config.php");
    $connDB = new mysqli(Config::$dbHost, Config::$dbUsername, Config::$dbPassword, Config::$dbname);
    if($connDB->connect_errno){
      printf("Connect failed: %s\n", $connDB->connect_error);
      exit();
    }else{
      return $connDB;
    }
  }public function connDatabasePDO(){
    @include_once("config.php");
    $connDB = new PDO('mysql:host='.Config::$dbHost.';dbname='.Config::$dbname, Config::$dbUsername, Config::$dbPassword);
    return $connDB;
  }
}

class systemData{
  public $siteName,$siteURL,$usernameSMS,$passwordSMS,$senderSMS,$keySMS;
  use connDatabase;

  public function __construct(){
    // Date default timezone
    @date_default_timezone_set('Africa/Cairo');
    // Create session
    $this->session = bin2hex(random_bytes(32));
    $this->siteName = 'E-store';
    $this->siteURL = 'http://localhost/';
    $this->usernameSMS = '';
    $this->passwordSMS = '';
    $this->senderSMS = '';
    $this->keySMS = '';
  }

  public function notifications(){
    // Check notifications
    if(@$_GET['id'] == ''){
      if(isset($_GET['process']) == 'logout'){
        $_SESSION['login'] = NULL;
        $_SESSION["shopping_cart"] = NULL;
        $this->swal('Good','Sign out successful','success');
      }
      if(@$_GET['success'] == 'send'){
        $this->swal('Good','The message has been successfully sent your email','success');
      }elseif(@$_GET['success'] == 'registration'){
        $this->swal('Good','successfully registered','success');
      }elseif(@$_GET['success'] == 'login'){
        $this->swal('Good','Sign-in successful','success');
      }elseif(@$_GET['error'] == 'authentication_error'){
        $this->swal('Error!','Error registration','error');
      }elseif(@$_GET['error'] == 'admin'){
        $this->swal('Error!','The control panel cannot be opened because there are not enough permissions','error');
      }
    }

    if(@$_GET['id'] == 'login'){
      if(@$_GET['error'] == 'login'){
        $this->swal('Error!','Data is incorrect. Login error','error');
      }elseif(@$_GET['error'] == 'admin'){
        $this->swal('Error!','You must log in first','error');
      }
    }

    if(@$_GET['id'] == 'shipping-info'){
      if(@$_GET['error'] == 'add'){
        $this->swal('Error!','Please do not leave any fields blank','error');
      }
    }

    if(@$_GET['id'] == 'addresses'){
      if(@$_GET['success'] == 'delete'){
        $this->swal('Good','The address was deleted successfully','success');
      }
    }

    if(@$_GET['id'] == 'payment-code'){
      if(@$_GET['success'] == 'order'){
        $this->swal('Good','Your request has been created, please send the order due to be activated','success');
      }
    }

    if(@$_GET['id'] == 'orders'){
      if(@$_GET['success'] == 'add'){
        $this->swal('Good','The book has been added successfully and you will be contacted to receive the book','success');
      }
    }

    if(@$_GET['id'] == 'store'){
      if(@$_GET['success'] == 'add'){
        $this->swal('Good','Orders are being checked','success');
      }elseif(@$_GET['success'] == 'checked'){
        $this->swal('Good','The book has been added successfully and you will be contacted to receive the book','success');
      }
    }

    if(@$_GET['id'] == 'add-new'){
      if(@$_GET['error'] == 'add'){
        $this->swal('Error!','Please do not leave any fields blank','error');
      }
    }

    if(@$_GET['id'] == 'select-store'){
      if(@$_GET['error'] == 'duplicate'){
        $this->swal('Error!','This book is a duplicate that you can choose from here and add it','error');
      }
    }

    if(@$_GET['id'] == 'registration-data'){
      // Check if SESSION code = code email
      if(@$_SESSION['code'] !== $_GET['code']){
        // Authentication Error
        @header("Location:./?error=authentication_error");
        exit();
      }if(@$_GET['error'] == 'name'){
        $this->swal('Error!','Do not leave the name blank','error');
      }elseif(@$_GET['error'] == 'email'){
        $this->swal('Error!',' The mail is invalid','error');
      }elseif(@$_GET['error'] == 'phone'){
        $this->swal('Error!',' The phone number must equal 11 numbers','error');
      }elseif(@$_GET['error'] == 'password'){
        $this->swal('Error!','Password must be more than 8 characters long and contain signs','error');
      }
    }

    if(@$_GET['id'] == 'interesting'){
      if(@$_GET['success'] == 'update'){
        $this->swal('Good',' The data has been updated','success');
      }
    }
  }

  public function encryption_encode($value){
    $value = md5($value);
    return $value;
  }

  function checkLogin($email=null,$password=null,$csrf){
     // Check the data
     if($email != NULL && $password != NULL){
       $email = $this->xss_clean(strtolower($email));
       $password = $this->xss_clean($password);
       if($this->checkCSRF($csrf)){
         $rowUser = $this->preparedQuery("SELECT * FROM users WHERE email=?",array($email),'select_row');
         if(!empty($rowUser)){
           $passwordDB = $this->encryption_encode($rowUser['password']);
           if(@hash_equals($password,$passwordDB)){
             return $rowUser; // Return Succeeded Results
           }else{
             return 'no_match'; // Return Error No match
           }
         }else{
           return 'not_found'; // Return Error Not Found
         }
       }else{
         return 'security'; // Return Error Security
       }
   }else{
     return 'null'; // Return Error NULL
   }

  }

  function checkCSRF($value){
    $csrf = @$_SESSION['csrf'];
    if($value != NULL && $csrf != NULL && @hash_equals($csrf, $value)){
      return true;
    }else{
      return false;
    }
  }

  public function security(){
    // Generate a key, print a form
      $this->csrf = @bin2hex(random_bytes(32));
      $_SESSION['csrf'] = $this->csrf;
  }

  public function swal($title,$subtitle,$type){
    echo '<script>
          document.addEventListener("DOMContentLoaded", function(event) {
            swal("'.$title.'", "'.$subtitle.'", "'.$type.'");
          });
          </script>';
  }

  public function PHPMailer($sender,$subject,$body,$emails=array()){
    require 'phpmailer.php';
  }

  public function preparedQuery($query, array $args = null, $type = null){
      $dbConnection = $this->connDatabase();
      $stmt   = $dbConnection->prepare($query);
      if ( false===$stmt ) {
        // and since all the following operations need a valid/ready statement object
        // it doesn't make sense to go on
        // you might want to use a more sophisticated mechanism than die()
        // but's it's only an example
        die('prepare() failed: ' . htmlspecialchars($mysqli->error));
      }
      if(!empty($args)){
        $params = [];
        $types  = array_reduce($args, function ($string, &$arg) use (&$params) {
            $params[] = &$arg;
            if (is_float($arg))         $string .= 'd';
            elseif (is_integer($arg))   $string .= 'i';
            elseif (is_string($arg))    $string .= 's';
            else                        $string .= 'b';
            return $string;
        }, '');
        array_unshift($params, $types);
        call_user_func_array([$stmt, 'bind_param'], $params);
      }
      $result = $stmt->execute() ? $stmt->get_result() : false;
      /*if ( false===$stmt->execute() ) {
        die('execute() failed: ' . htmlspecialchars($stmt->error));
      }*/
      if($type == 'select_row'){
        $result = $result->fetch_array();
      }elseif($type == 'num'){
        $result = floor($result->num_rows);
      }elseif($type == 'insert'){
        $result = $dbConnection->insert_id;
      }
      $stmt->close();
      $dbConnection->close();
      return $result;
}

public function xss_clean_arr(array $data,$type){
  $arr = array();
  foreach ($data as $value) {
    ($type == 'post') ? $val = @$_POST[$value] : $val = @$_GET[$value];
    $arr[$value] = $this->xss_clean($val);
  }
  return $arr;
}

public function xss_clean($data=null){
    if($data != NULL){
      $data = @htmlentities($data, ENT_QUOTES, 'UTF-8', false); // ENT_QUOTES | ENT_HTML5
      $data = @strip_tags($data);
      $search = @array('@<script[^>]*?>.*?</script>@si',
              '@<[\/\!]*?[^<>]*?>@si',
              '@<style[^>]*?>.*?</style>@siU',
              '@<![\s\S]*?--[ \t\n\r]*>@'
       );
       $data = @preg_replace($search, '', $data);
      // realign javascript href to onclick
        $data = @preg_replace("/href=(['\"]).*?javascript:(.*)?\\1/i", "onclick=' $2 '", $data);
      //remove javascript from tags
        while( @preg_match("/<(.*)?javascript.*?\(.*?((?>[^()]+)|(?R)).*?\)?\)(.*)?>/i", $data))
        $data = preg_replace("/<(.*)?javascript.*?\(.*?((?>[^()]+)|(?R)).*?\)?\)(.*)?>/i", "<$1$3$4$5>", $data);
      // dump expressions from contibuted content
        if(0) $data = preg_replace("/:expression\(.*?((?>[^(.*?)]+)|(?R)).*?\)\)/i", "", $data);
        while( @preg_match("/<(.*)?:expr.*?\(.*?((?>[^()]+)|(?R)).*?\)?\)(.*)?>/i", $data))
        $data = preg_replace("/<(.*)?:expr.*?\(.*?((?>[^()]+)|(?R)).*?\)?\)(.*)?>/i", "<$1$3$4$5>", $data);
      // remove all on* events
        while( @preg_match("/<(.*)?\s?on.+?=?\s?.+?(['\"]).*?\\2\s?(.*)?>/i", $data) )
        $data = @preg_replace("/<(.*)?\s?on.+?=?\s?.+?(['\"]).*?\\2\s?(.*)?>/i", "<$1$3>", $data);

      // Fix &entity\n;
      $data = @str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
      $data = @preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
      $data = @preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
      $data = @html_entity_decode($data, ENT_COMPAT, 'UTF-8');
      // Remove any attribute starting with "on" or xmlns
      $data = @preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);
      // Remove javascript: and vbscript: protocols
      $data = @preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
      $data = @preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
      $data = @preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);
      // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
      $data = @preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
      $data = @preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
      $data = @preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);
      // Remove namespaced elements (we do not need them)
      $data = @preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);
      do{
          // Remove really unwanted tags
          $old_data = $data;
          $data = @preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
      }while ($old_data !== $data);
      // we are done...
      return $data;
    }else{
      return '';
    }
  }

  public function sendSMS($message,$language,$phones=array()){
    if($_SESSION['SMS'] == 'enable'){
      // Get languages
  		($language == 'arabic') ? $language = 2 : $language = 1;
      foreach ($phones as $phone) {
        $data = array(
            'username' => $this->usernameSMS,
            'password' => $this->passwordSMS,
            'language' => $language,
            'sender'   => $this->senderSMS,
            'mobile'   => $this->keySMS.$phone,
            'message'  => $message
        );
        $url = $this->HTTPGet('https://www.smsmisr.com/api/send/', $data);
        $arr = explode(',', $url);
        $credit = str_replace('credit:', "", $arr[3]);
        // Check if true Send sms
        if($credit != NULL){
          return true;
        }else{
          return false;
        }
      }
    }else{
      return false;
    }
  }




  public function uploadPhoto($name,$dirUp,$prefix=null){
    if(!empty($_FILES[$name]['name'])){
      $output = NULL;
      if(!is_array($_FILES[$name]['name'])){
        $arrName = array($_FILES[$name]['name']);
        $arrType = array($_FILES[$name]['type']);
        $arrTmpName = array($_FILES[$name]['tmp_name']);
        $arrSize = array($_FILES[$name]['size']);
      }else{
        $arrName = $_FILES[$name]['name'];
        $arrType = $_FILES[$name]['type'];
        $arrTmpName = $_FILES[$name]['tmp_name'];
        $arrSize = $_FILES[$name]['size'];
      }if($prefix == NULL){$prefix = '';}

      $total = count($arrName);
      for($i=0;$i<$total;$i++){
        ini_set('memory_limit', '-1');
        $imagename = str_replace(" ", "_", $arrName[$i]);
        $parts = pathinfo($imagename);
        $imagename = str_replace('.', '', $parts['filename']).'.'.$parts['extension'];
        $imagename = rand(1000,100000)."-".$imagename;
        $source = $arrTmpName[$i];
        $file = $dirUp."/".$imagename;
        $imagename = str_replace(".jpeg", ".jpg", $imagename);
        if(exif_imagetype($source)){
          move_uploaded_file($source, $file);
          $output .= $dirUp."/".$imagename.',';
      }else{
        $output = false;
      }
    }

    $arrImages = explode(',', $output);
    if(file_exists($arrImages[0])){
      $output = substr($output, 0, -1);
      $output = str_replace(array('../','upload/'), array('',''), $output);
      return $output;
    }else{
      $output = false;
      return $output;
    }
  }else{
    echo 'error';
  }
}

}

$systemData = new systemData;
$systemData->notifications(); ?>
