<?php
@include("functions.php");

class check extends systemData{

  public function checkPayment($get){

    if(isset($_GET['api'])){
      // Filter input
      $arr = $this->xss_clean_arr(array('api','code','price'),'get');

      if(md5('Ebook'.date('m-Y').'Payment') == $arr['api']){

        $payment = $this->preparedQuery("SELECT * FROM payment WHERE code=?",array($arr['code']),'select_row');

        if($payment['id']){
          if($payment['status'] == 'unpaid'){

            $price = $this->preparedQuery("SELECT total_price FROM orders WHERE id=?",array($payment['order_id']),'select_row')['total_price'];
            if($price == $arr['price']){

              // Update
              $this->preparedQuery("UPDATE payment SET status='paid' WHERE code=?",array($arr['code']));

              // Status
              $response = 'Paid';

            }else{
              $response = 'AmountIncorrect';
            }

          }else{
            $response = 'OrderIsPaid';
          }

        }else{
          $response = 'NoPayment';
        }

      }else{
        $response = 'ErrorServiceProvider';
      }
    }

    echo base64_encode(json_encode(array('status' => $response)));
  }


}
$check = new check;

// Run Check Payment
$check->checkPayment($_GET); ?>
