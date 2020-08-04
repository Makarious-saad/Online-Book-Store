<?php echo $this->header(); ?>
  <br><br><br><br><br><br>
  <div class="container"> <!-- 1st Part -->
    <h2 class=" text-white text-center">Addresses</h2>
    <div class="row mt-5">
      <?php $result = $this->preparedQuery("SELECT * FROM addresses WHERE user_id=? ORDER BY id DESC",array($_SESSION['UserID']));
            while ($row = $result->fetch_array()){
              $area = $this->preparedQuery("SELECT * FROM areas WHERE id=?",array($row['area_id']),'select_row');
              $city = $this->preparedQuery("SELECT name FROM cities WHERE id=?",array($area['city_id']),'select_row')['name']; ?>


            <div class="col-md-6 text-white">
              <div class="row">
                <h4>First Name : <span> <?php echo $row['first_name']; ?></span> </h4>
                <hr class="hr text-white">
              </div>
              <div class="row">
                <h4>Last Name : <span> <?php echo $row['last_name']; ?></span></h4>
                <hr class="hr text-white">
              </div>
              <div class="row">
                <h4>Phone Number : <span>  <?php echo $row['phone']; ?></span></h4>
                <hr class="hr text-white">
              </div>
              <div class="row">
                <h4>City : <span> <?php echo $city; ?></span></h4>
                <hr class="hr text-white">
              </div>
              <div class="row">
                <h4>Area : <span> <?php echo $area['name']; ?></span></h4>
                <hr class="hr text-white">
              </div>
              <div class="row">
                <h4>Street : <span> <?php echo $row['street_st']; ?></span></h4>
                <hr class="hr text-white">
              </div>
              <div class="row text-center mt-2">
                <form action="include/check.php" method="post">
                  <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="deleteAddress" class="btn btn-outline-light mx-2 my-sm-0 btn-lg">Delete</button>
                </form>
              </div>
            </div>

      <?php }


          $addresses = $this->preparedQuery("SELECT id FROM addresses WHERE user_id=?",array($_SESSION['UserID']),'num');
          if($addresses == 0){ ?>

              <div class="col-md-12 text-red text-center">
                <h4>There are no added addresses</h4>
                <hr class="hr text-white">
              </div>

      <?php } ?>

    </div>



<?php include("style/footer.php"); ?>
