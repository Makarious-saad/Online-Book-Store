<?php echo $this->header();
      if(!isset($_SESSION['login'])){
        // Redirection
        @header("Location: /login?error=admin");
        exit();
      } ?>

<br><br><br><br><br><br>
<div class="row justify-content-center">
  <div class="col-7" >
    <div class="emailentry">

      <h3 class="text-white display-5">Old book</h3>
      <form action="/include/check.php" method="post" enctype="multipart/form-data">
        <div class="container text-center mt-2 mx-auto">

          <div class="row">
            <!-- Search Bar -->
            <div class="col-8">
              <div class="searchbooks">
                  <div class="row">
                    <div class="col-12">
                      <select class="form-control" name="isbn" required>
                        <option selected disabled>Select Book</option>
                        <?php $result = $this->preparedQuery("SELECT * FROM books ORDER BY id DESC");
                              while ($row = $result->fetch_array()){
                                echo '<option value="'.$row['id'].'">#'.$row['id'].' - '.$row['title'].'</option>';
                              } ?>
                      </select>
                    </div>
                  </div>
              </div>
            </div>

          </div>
          <div class="row justify-content-center mt-2 ml-5">
            <div class="col-md-6 text-center">
              <input type="submit" name="resale-old" value="Proceed to shipping" class="btn btn-outline-light mx-2 my-sm-0 btn-lg">
              <!--End of Search Bar -->
            </div>
            <div class="col-md-6">

            </div>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>
<!-- End of the container -->

<?php include("style/footer.php"); ?>
<script src="assets/js/all.js"></script>
<script src="assets/js/script.js"></script>
