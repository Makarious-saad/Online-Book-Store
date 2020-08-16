<?php echo $this->header();
      $user = $this->preparedQuery("SELECT * FROM users WHERE email=?",array($_SESSION['login']),'select_row');
      $_SESSION['QTY'] = 0;
      $commission = 0; ?>

<br><br><br><br><br><br>
<div class="row justify-content-center">
  <div class="col-7" >
    <div class="emailentry">
      <h3 class="text-white display-5">Payment</h3>
      <?php if(isset($_SESSION['login']) && @$_SESSION['Area'] !== NULL){ ?>
        <form action="/include/check.php" method="post">
          <div class="table-responsive" id="order_table">
           <table class="table table-bordered table-striped" style="background-color: white;">
             <thead>
                <tr>
                    <th width="40%">Product Name</th>
                    <th width="10%">Quantity</th>
                    <th width="20%">Price</th>
                    <th width="15%">Total</th>
                </tr>
              </thead>
              <tbody>
        <?php foreach($_SESSION["shopping_cart"] as $keys => $values){
                $total_price = $total_price + ($values["product_quantity"] * $values["product_price"]);
                $total_item = $total_item + 1;
                $_SESSION['QTY'] = $_SESSION['QTY'] + $values["product_quantity"]; ?>

                 <tr>
                  <td><?php echo $values["product_name"]; ?></td>
                  <td><?php echo $values["product_quantity"]; ?></td>
                  <td align="right"><?php echo $values["product_price"]; ?></td>
                  <td align="right"><?php echo number_format($values["product_quantity"] * $values["product_price"], 2); ?></td>
                 </tr>

        <?php  } ?>

                <tr>
                 <td><?php echo 'Shipping to '.$_SESSION['Area'].' - '.$_SESSION['City']; ?></td>
                 <td>-</td>
                 <td align="right"><?php echo $_SESSION['ShippingFee']; ?></td>
                 <td align="right"><?php echo number_format($_SESSION['ShippingFee'], 2); ?></td>
                </tr>

              </tbody>
              
                <tr>
                  <?php if($user['type'] == 'seller'){
                          $commission = (5 * intval($total_price + $_SESSION['ShippingFee']) / 100); ?>
                 <td colspan="3" align="right">Commission value - 5% <br> Total</td>
                 <td align="right"><?php echo number_format($commission, 2); ?> <br>
                                   <?php echo number_format($total_price + $_SESSION['ShippingFee'] + $commission, 2); ?></td>
                    <?php  }else{ ?>
                      <td colspan="3" align="right">Total</td>
                      <td align="right"><?php echo number_format($total_price + $_SESSION['ShippingFee'] + $commission, 2); ?></td>

                    <?php  } ?>
                </tr>

                <tfoot>
                  <tr>
                   <td colspan="5" align="center">
                     <input type="hidden" name="total_price" value="<?php echo $total_price + $_SESSION['ShippingFee'] + $commission; ?>">
                     <input type="hidden" name="qty" value="<?php echo $_SESSION['QTY']; ?>">
                     <button type="submit" name="order-now" class="btn btn-success btn-xs">Order Now</button>
                   </td>
                  </tr>
                </tfoot>
              </table>
            </div>


      <?php }elseif(@$_SESSION['Area'] == NULL){ ?>
          <div class="alert alert-danger text-center">Please complete this step first <a href="/shipping-info">Back</a></div>
      <?php }elseif(isset($_SESSION['login']) && $user['type'] == 'seller'){ ?>
              <div class="alert alert-danger text-center">Please contact the administration to change your account system from seller to buyer</div>
      <?php }else{ ?>
          <div class="alert alert-danger text-center">Please sign in</div>
      <?php } ?>
      </form>
    </div>
  </div>
</div> <!--End of Register -->

<?php include("style/footer.php"); ?>
