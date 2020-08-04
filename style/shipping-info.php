<?php echo $this->header();

// Make SESSION NULL
$_SESSION['Area'] = NULL;
$_SESSION['AreaID'] = NULL;
$_SESSION['City'] = NULL;
$_SESSION['ShippingFee'] = NULL; ?>

<br><br><br><br><br><br>
<div class="container text-white justify-content-center">
  <h2>Shipping Destination</h2>
  <?php if(!isset($_SESSION['login'])){ ?>
          <div class="alert alert-danger text-center mt-5">Please sign in!</div>
  <?php }if(isset($_SESSION['login']) && (!empty($_SESSION["shopping_cart"]) || @$_SESSION["shopping_cart"] == 'resale')){ ?>
    <ul class="nav nav-tabs">
      <li class="active mr-2"><a data-toggle="tab" href="#home" class="btn btn-outline-light mx-2 my-sm-0">Existing Address</a></li>
      <li><a data-toggle="tab" href="#menu1" class="btn btn-outline-light mx-2 my-sm-0">New Address</a></li>
    </ul>
    <div class="tab-content">
      <div id="home" class="tab-pane fade in active mt-2">
        <h3>Choose an already existing address</h3>
        <form action="/include/check.php" method="post">
           <select class="browser-default custom-select mb-3" name="address" required>
             <option selected disabled>Select Address</option>
             <?php $result = $this->preparedQuery("SELECT * FROM addresses WHERE user_id=? ORDER BY id DESC",array($_SESSION['UserID']));
                   while ($row = $result->fetch_array()){
                     $area = $this->preparedQuery("SELECT * FROM areas WHERE id=?",array($row['area_id']),'select_row');
                     $city = $this->preparedQuery("SELECT name FROM cities WHERE id=?",array($area['city_id']),'select_row')['name'];
                     echo '<option value="'.$row['id'].'">'.$row['first_name'].' '.$row['last_name'].' - '.$area['name'].' - '.$city.'</option>';
                   } ?>
           </select>
           <div class="row justify-content-center">
            <div class="col-md-4">
                <input type="submit" name="checkoutID" value="Confirm Address" class="btn btn-outline-light btn-lg mx-2 my-sm-0">
            </div>
           </div>
        </form>
      </div>
      <div id="menu1" class="tab-pane fade mt-2">
        <h3>Add a new Address</h3>
        <form action="/include/check.php" method="post">
          <div class="row justify-content-center mb-3">
            <div class="row">
              <div class="col-md-4">
                <input type="text" class="form-control" placeholder="First name" name="first_name" required>
              </div>
              <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Last name" name="last_name" required>
              </div>
              <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Phone" name="phone" required>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-md-6">
                <select class="browser-default custom-select" name="area" required>
                  <option selected disabled>Select area</option>
                  <?php $result = $this->preparedQuery("SELECT * FROM areas ORDER BY id DESC");
                        while ($row = $result->fetch_array()){
                          $city = $this->preparedQuery("SELECT name FROM cities WHERE id=?",array($row['city_id']),'select_row')['name'];
                          echo '<option value="'.$row['id'].'">'.$row['name'].' - '.$city.'</option>';
                        } ?>
                </select>
              </div>
              <div class="col-md-6">
                <input type="text" class="form-control" placeholder="Street" name="street" required>
              </div>
            </div>
          </div>
          <input type="submit" name="checkoutAddress" value="Confirm Address" class="btn btn-outline-light btn-lg mx-2 my-sm-0">
          <input type="reset" value="Reset" class="btn btn-outline-light  btn-lg mx-2 my-sm-0">
        </form>
      </div>
    </div>
  <?php }if(empty($_SESSION["shopping_cart"]) && @$_SESSION["shopping_cart"] == NULL){ ?>
          <div class="alert alert-danger text-center mt-5">Your Cart is Empty!</div>
  <?php } ?>
</div> <!-- End of the container -->

<?php include("style/footer.php"); ?>
<script src="assets/js/all.js"></script>
<script src="assets/js/script.js"></script>
