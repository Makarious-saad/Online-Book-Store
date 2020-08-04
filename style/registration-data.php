<?php echo $this->header(); ?>
<style>
  .txtwhite{
    color:white;
    font-weight:bold;
  }
</style>

<br><br><br><br><br><br>
<div class="row justify-content-center">
  <div class="col-7" >
    <div class="emailentry">
      <h3 class="text-white display-5">Please complete Registeration</h3>
      <form id="registration_form" action="include/check.php" method="post">
        <div class="row">
          <div class="col-lg-8 col-md-6  col-sm-4">
            <div style="margin-bottom: 2%;">
              <input type="text" class="form-control form-control-lg" id="form_fname" name="frist_name" required="" placeholder="First Name">
              <span class="error_form txtwhite" id="fname_error_message"></span>
            </div>
            <div style="margin-bottom: 2%;">
              <input type="text" class="form-control form-control-lg"id="form_sname" name="last_name" required="" autocomplete="new-password" placeholder="Last Name">
              <span class="error_form txtwhite" id="sname_error_message"></span>
            </div>
            <div style="margin-bottom: 2%;">
              <input type="number" class="form-control form-control-lg" id="form_phone" name="phone" required="" autocomplete="new-password" placeholder="Phone">
              <span class="error_form txtwhite" id="form_phone_error_message"></span>
            </div>
            <div style="margin-bottom: 2%;">
              <input type="password" class="form-control form-control-lg" id="form_password" name="password" required="" autocomplete="new-password" placeholder="Password">
              <span class="error_form txtwhite" id="password_error_message"></span>
            </div>
          <div style="margin-bottom: 2%;">
            <input type="password" class="form-control form-control-lg" id="form_retype_password" name="confirm_password" required="" autocomplete="new-password" placeholder="Confirm Password">
            <span class="error_form txtwhite" id="retype_password_error_message"></span>
          </div>
          <div style="margin-bottom: 2%;">
            <select class="form-control form-control-lg" name="type">
              <option value="buyer" selected>Buyer</option>
              <option value="seller">Seller</option>
            </select>

          </div>
            <input type="submit" value="Complete Registeration" name="newUser" class="btn btn-outline-light" name="">
          </div>
        <div class="col-lg-2 col-md-3 col-sm-2">
        </div>
      </div>
      </form>
    </div>
  </div>
</div> <!--End of Register -->

<?php include("style/footer.php"); ?>
<script type="text/javascript" src="style/assets/js/verify.js"></script>
