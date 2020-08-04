<?php
//fetch_cart.php

session_start();

$total_price = 0;
$total_item = 0;

$output = '
<div class="table-responsive" id="order_table">
 <table class="table table-bordered table-striped" style="background-color: white;">
   <thead>
      <tr>
          <th width="40%">Product Name</th>
          <th width="10%">Quantity</th>
          <th width="20%">Price</th>
          <th width="15%">Total</th>
          <th width="5%">Action</th>
      </tr>
    </thead>
    <tbody>
';
if(!empty($_SESSION["shopping_cart"]))
{
 foreach($_SESSION["shopping_cart"] as $keys => $values)
 {
  $output .= '
  <tr>
   <td>'.$values["product_name"].'</td>
   <td>'.$values["product_quantity"].'</td>
   <td align="right">'.$values["product_price"].' EGP</td>
   <td align="right">'.number_format($values["product_quantity"] * $values["product_price"], 2).' EGP</td>
   <td><button name="delete" class="btn btn-danger btn-xs delete" id="'. $values["product_id"].'">Remove</button></td>
  </tr>
  ';
  $total_price = $total_price + ($values["product_quantity"] * $values["product_price"]);
  $total_item = $total_item + 1;
 }
 $output .= '
 <tr>
        <td colspan="3" align="right">Total</td>
        <td align="right">'.number_format($total_price, 2).' EGP</td>
        <td></td>
    </tr>
 ';
}
else
{
 $output .= '
    <tr>
     <td colspan="5" align="center">
      Your Cart is Empty!
     </td>
    </tr>
    ';
}
$output .= '</tbody>';
  if(!empty($_SESSION["shopping_cart"])){
    $output .= '<tfoot>
    <tr>
     <td colspan="5" align="center">
      <a href="/shipping-info" class="btn btn-success btn-xs">Checkout</a> -
      <a href="/card" class="btn btn-dark btn-xs" id="clear_cart">Clear</a>
     </td>
    </tr>
    </tfoot>';
    }
$output .= '</table>

</div>';
$_SESSION["total_price"] = number_format($total_price, 2);
$data = array(
 'cart_details'  => $output,
 'total_price'  =>  number_format($total_price, 2).' EGP',
 'total_item'  => $total_item
);

echo json_encode($data);
