<?php echo $this->header();
$user = $this->preparedQuery("SELECT * FROM users WHERE email=?",array($_SESSION['login']),'select_row'); ?>

  <br><br><br><br><br><br>
  <div class="container"> <!-- 1st Part -->
  <h2 class=" text-white text-center">Dashboard</h2>
  <div class="row justify-content-center mt-5">
    <div class="col-2 text-center">
      <a class="btn btn-outline-light" href="./interesting" >Interesting</a>
    </div>
    <div class="col-2 text-center">
      <a class="btn btn-outline-light" href="./favorite" >Favorite</a>
    </div>
    <div class="col-2 text-center">
      <a class="btn btn-outline-light" href="./addresses" >Addresses</a>
    </div>
  <?php if($user['type'] == 'buyer'){ ?>
    <div class="col-2 text-center">
      <a class="btn btn-outline-light" href="./orders" >Orders</a>
    </div>
  <?php }if($user['type'] == 'seller'){ ?>
    <div class="col-2 text-center">
      <a class="btn btn-outline-light" href="./store" >Store</a>
    </div>

      <div class="row justify-content-center mt-5">
        <div class="col-12 text-center">
          <h2 class="text-white"> Want to Resale a Book?</h2>
        </div>
        <div class="col-12 text-center mt-2">
          <a href="/add-new"><input type="Button" value="Add New" class="btn btn-outline-light mx-2 my-sm-0 btn-lg"></a>
          <a href="/select-store"><input type="Button" value="Select from store" class="btn btn-outline-light mx-2 my-sm-0 btn-lg"></a>
        </div>
      </div>
    <?php } ?>

  </div>



<?php include("style/footer.php"); ?>
