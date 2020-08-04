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
      <form action="/include/check.php" method="post" enctype="multipart/form-data">
      <div class="container text-center mt-2 mx-auto">
        <div class="row mx-auto"><h2 class="text-white">New Book Info</h2></div>
        <div class="row text-white">
          <div class="col-md-6 form-group">
            <input type="text"class="mb-1 form-control-lg" placeholder="#ISBN" name="isbn" required>
            <input type="text" class="mb-1 form-control-lg" placeholder="Book Title" name="title" required>
            <input type="number" class="mb-1 form-control-lg" placeholder="Price" name="price" required>
            <input type="date" class="mb-1 form-control-lg" name="released" required>


            <div class="row">
              <label for="img">Select Book Cover :</label>
              <input type="file" id="img" name="cover" accept="image/*" required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="row">
              <div class="form-group">
                <textarea class="form-control" rows="5" cols="40" name="description" placeholder="Book Description" required></textarea>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <select class="form-control" name="category" required>
                  <option selected disabled>Select category</option>
                  <?php $result = $this->preparedQuery("SELECT * FROM categories ORDER BY id DESC");
                        while ($row = $result->fetch_array()){
                          echo '<option value="'.$row['id'].'">'.$row['title'].'</option>';
                        } ?>
                </select>
                </div>
                <div class="col-md-12"></div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <select class="form-control" name="author" required>
                  <option selected disabled>Select author</option>
                  <?php $result = $this->preparedQuery("SELECT * FROM authors ORDER BY id DESC");
                        while ($row = $result->fetch_array()){
                          echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                        } ?>
                </select>
                </div>
                <div class="col-md-12"></div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <select class="form-control" name="publisher" required>
                  <option selected disabled>Select publisher</option>
                  <?php $result = $this->preparedQuery("SELECT * FROM publishers ORDER BY id DESC");
                        while ($row = $result->fetch_array()){
                          echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                        } ?>
                </select>
              </div>
              <div class="col-md-12"></div>
            </div>
          </div>
          <div class="row justify-content-center mx-auto mt-5">
            <input type="submit" name="resale-new" value="Confirm &amp; Proceed to shipping" class="btn btn-outline-light mx-2 my-sm-0 btn-lg" onclick="return ISBNVali();">
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
