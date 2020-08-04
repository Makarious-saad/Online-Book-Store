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
      $row = mysqli_fetch_array($results);
      $amount = $row['amount'] - $price ;
      mysqli_query ($db, "UPDATE payment SET amount = ".$amount." WHERE user_code = ".$user);
      echo 'You are now pay';
    }elseif($checkPayment['status'] == 'NoPayment'){
      echo "The payment code appears to be incorrect";
    }elseif($checkPayment['status'] == 'AmountIncorrect'){
      echo "The amount sent is incorrect";
    }elseif($checkPayment['status'] == 'PriceLow'){
      echo "The price you will pay is less than required";
    }elseif($checkPayment['status'] == 'ErrorServiceProvider'){
      echo "Error in calling service provider";
    }else{
      echo "Payment error";
    }

  }else{

    echo "You don't have money";

  }

}else{

  echo 'Error';

}
?>
