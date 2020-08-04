<?php echo $this->header(); ?>

<br><br><br><br><br><br>
<div class="row justify-content-center">
  <div class="col-12" >
    <div class="emailentry">
      <h3 class="text-white display-5">Orders</h3>

          <div class="table-responsive" id="order_table">
           <table class="table table-bordered table-striped" style="background-color: white;font-size: small;">
             <thead>
                <tr>
                    <th class="text-center">Order ID</th>
                    <th class="text-center">Payment Code</th>
                    <th class="text-center">Products</th>
                    <th class="text-center">Area-City</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Payment status</th>
                    <th class="text-center">Shipping status</th>
                    <th class="text-center">Order status</th>
                </tr>
              </thead>
              <tbody>
        <?php $result = $this->preparedQuery("SELECT * FROM orders WHERE user_id=? AND resale_book=0 ORDER BY created_at DESC",array($_SESSION['UserID']));
              $orderNum = $this->preparedQuery("SELECT * FROM orders WHERE user_id=?",array($_SESSION['UserID']),'num');
              while ($row = $result->fetch_array()){
                $products = NULL;
                $paymentCode = '-';
                $paymentStatus = '-';
                $address = $this->preparedQuery("SELECT * FROM addresses WHERE id=?",array($row['address_id']),'select_row');
                $area = $this->preparedQuery("SELECT * FROM areas WHERE id=?",array($address['area_id']),'select_row');
                $city = $this->preparedQuery("SELECT name FROM cities WHERE id=?",array($area['city_id']),'select_row')['name'];
                $shipment = $this->preparedQuery("SELECT status FROM shipment WHERE order_id=?",array($row['id']),'select_row')['status'];

                if($row['products'] !== '[]'){
                  $payment= $this->preparedQuery("SELECT * FROM payment WHERE order_id=? AND user_id=?",array($row['id'],$_SESSION['UserID']),'select_row');
                  $paymentCode = '#'.$payment['code'];
                  $paymentStatus = ucfirst($payment['status']);
                  foreach (json_decode($row['products'], true) as $key => $value) {
                    $book = $this->preparedQuery("SELECT title FROM books WHERE id=? ",array($value),'select_row')['title'];
                    $products .= '<a href="/book&bookid='.$value.'" target="_blank">'.$book.'</a> <br>';
                  }
                  $products = mb_substr($products, 0, -4);
                }?>

                 <tr>
                  <td class="align-middle text-center">#<?php echo $row["id"]; ?></td>
                  <td class="align-middle text-center"><?php echo $paymentCode; ?></td>
                  <td class="align-middle text-center"><?php echo $products; ?></td>
                  <td class="align-middle text-center"><?php echo $address['street_st']. ' <br> '.$area['name'].' - '.$city; ?></td>
                  <td class="align-middle text-center"><?php echo $row["total_price"].' EGP'; ?></td>
                  <td class="align-middle text-center text-primary"><?php echo $paymentStatus; ?></td>
                  <td class="align-middle text-center text-primary"><?php echo ucfirst($shipment); ?></td>
                  <td class="align-middle text-center text-primary"><?php echo ucfirst($row['status']); ?></td>
                 </tr>

        <?php  }if($orderNum == 0){ ?>
                <tr>
                 <td colspan="8" align="center">
                   There are no orders
                 </td>
                </tr>
        <?php  } ?>

              </tbody>
              </table>
            </div>




    </div>
  </div>
</div> <!--End of Register -->

<?php include("style/footer.php"); ?>
