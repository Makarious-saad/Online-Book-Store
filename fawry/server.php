<?php
$user = intval($_POST['user']);
$code = intval($_POST['code']);
$price = floatval($_POST['price']);

// payment USER
if (isset($_POST['payment_user'])) {

  // connect to the database
  $db = mysqli_connect('localhost', 'root', 'root', 'fawry');

  if ($price == 0) {
  	echo "price is required";
    exit();
  }elseif ($code == 0) {
  	echo "code is required";
    exit();
  }elseif ($user == 0) {
    echo "your code is required";
    exit();
  }

	$query = "SELECT * FROM payment WHERE user_code = ".$user." AND amount >= ".$price;
	$results = mysqli_query ($db, $query);


	if (mysqli_num_rows($results) == 1) {
    // API Ebook
    $api = md5('Ebook'.date('m-Y').'Payment');
    $url = base64_decode(file_get_contents('http://localhost:8888/include/pay.php?api='.$api.'&code='.$code.'&price='.$price, true));
    $checkPayment = json_decode($url, true);

    // [Paid] - [NoPayment] - [OrderIsPaid] - [PriceLow]

    if($checkPayment['status'] == 'Paid'){
      @header("Location: /fawry/?status=Paid");
    }elseif($checkPayment['status'] == 'NoPayment'){
      @header("Location: /fawry/?status=NoPayment");
    }elseif($checkPayment['status'] == 'AmountIncorrect'){
      @header("Location: /fawry/?status=AmountIncorrect");
    }elseif($checkPayment['status'] == 'PriceLow'){
      @header("Location: /fawry/?status=PriceLow");
    }elseif($checkPayment['status'] == 'ErrorServiceProvider'){
      @header("Location: /fawry/?status=ErrorServiceProvider");
    }else{
      @header("Location: /fawry/?status=Error");
    }

  }else{
    @header("Location: /fawry/?status=NoMoney");
  }

}else{
  @header("Location: /fawry/?status=DataIncomplete");
}
?>
