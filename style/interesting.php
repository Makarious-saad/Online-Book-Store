<?php echo $this->header();
// Interesting
$interesting = $this->preparedQuery("SELECT interesting FROM users WHERE email=?",array($_SESSION['login']),'select_row')['interesting'];
$interesting = json_decode($interesting, true); ?>

  <br><br><br><br><br><br>
  <div class="container"> <!-- 1st Part -->
  <form action="include/check.php" method="post">
    <h2 class=" text-white text-center">What Are You Interested In..?</h2>
    <div class="form-group text-white font-weight-normal row mx-auto">
        <div class="col-sm-1">Book Category</div>
        <div class="col-sm-5">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="checkbox1" value="checked" <?php echo $interesting[0]["checkbox1"]; ?> id="gridCheck1">
            <label class="form-check-label" for="gridCheck1">
              Computer Science
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="checkbox2" value="checked" <?php echo $interesting[1]["checkbox2"]; ?> id="gridCheck2">
            <label class="form-check-label" for="gridCheck2">
              Information Technology
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="checkbox3" value="checked" <?php echo $interesting[2]["checkbox3"]; ?> id="gridCheck3">
            <label class="form-check-label" for="gridCheck3">
              Database Management
            </label>
          </div>
        </div>
        <div class="col-sm-1">Favorite Publisher</div>
        <div class="col-sm-5">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="checkbox4" value="checked" <?php echo $interesting[3]["checkbox4"]; ?> id="gridCheck4">
            <label class="form-check-label" for="gridCheck4">
              Publisher Name #1
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="checkbox5" value="checked" <?php echo $interesting[4]["checkbox5"]; ?> id="gridCheck5">
            <label class="form-check-label" for="gridCheck5">
              Publisher Name #2
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="checkbox6" value="checked" <?php echo $interesting[5]["checkbox6"]; ?> id="gridCheck6">
            <label class="form-check-label" for="gridCheck6">
            Publisher Name #3
            </label>
          </div>
        </div>
      </div>




      <!-- 2nd part -->
      <div class="form-group text-white font-weight-normal row mx-auto">
          <div class="col-sm-1">Book Country</div>
          <div class="col-sm-5">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="checkbox7" value="checked" <?php echo $interesting[6]["checkbox7"]; ?> id="gridCheck7">
              <label class="form-check-label" for="gridCheck7">
                United States
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="checkbox8" value="checked" <?php echo $interesting[7]["checkbox8"]; ?> id="gridCheck8">
              <label class="form-check-label" for="gridCheck8">
                United Kingdom
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="checkbox9" value="checked" <?php echo $interesting[8]["checkbox9"]; ?> id="gridCheck9">
              <label class="form-check-label" for="gridCheck9">
                India
              </label>
            </div>
          </div>
          <div class="col-sm-1">Book Condition</div>
          <div class="col-sm-5">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="checkbox10" value="checked" <?php echo $interesting[9]["checkbox10"]; ?> id="gridCheck10">
              <label class="form-check-label" for="gridCheck10">
                New
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="checkbox11" value="checked" <?php echo $interesting[10]["checkbox11"]; ?> id="gridCheck11">
              <label class="form-check-label" for="gridCheck11">
                Old
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="checkbox12" value="checked" <?php echo $interesting[11]["checkbox12"]; ?> id="gridCheck12">
              <label class="form-check-label" for="gridCheck12">
              No Preference
              </label>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <input class="btn btn-outline-light" type="submit" name="interesting" value="Complete Registertaion">
        </div>
      </div>
    </form>


<?php include("style/footer.php"); ?>
