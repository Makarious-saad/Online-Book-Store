<?php echo $this->header(); ?>

<br><br><br><br><br><br>
<div class="row justify-content-center">
  <div class="col-7" >
    <div class="emailentry">
      <h3 class="text-white display-5">Please Input your E-mail to Register</h3>
      <form action="include/check.php" method="post">
        <div class="row">
          <div class="col-lg-8 col-md-6  col-sm-4">
            <input type="email" name="email" class="form-control form-control-lg" placeholder="Your Email" id="email">
            <span id="span1">Enter a Valid Email Address</span>
            <span id="span2">This field can't be Empty</span>
          </div>
        <div class="col-lg-2 col-md-3 col-sm-2">
          <input type="submit" value="Register" name="checkMail" class="btn btn-outline-light">
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- End of the container -->

<?php include("style/footer.php"); ?>
