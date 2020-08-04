<footer class="bg-white sticky-footer">
		<div class="container my-auto">
				<div class="text-center my-auto copyright"><span>Copyright © E-Store2020</span></div>
		</div>
</footer>

<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="https://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.js"></script>
<script src="assets/js/theme.js"></script>

<?php if(!isset($_SESSION['login'])){
        // Redirection
        @header("Location:../login?error=admin");
        exit();
      }else{
        $accountType = $systemData->preparedQuery("SELECT account_type FROM users WHERE email=?",array($_SESSION['login']),'select_row')['account_type'];
        if($accountType == 'user'){
          // Redirection
          @header("Location:../?error=admin");
          exit();
        }
      } ?>
