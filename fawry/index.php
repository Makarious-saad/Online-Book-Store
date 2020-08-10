<!DOCTYPE html>
<html>
<head>
  <title>Fawry</title>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!------ Include the above in your HEAD tag ---------->

  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/css.css" rel="stylesheet">
  <script src="assets/sweetalert.min.js"></script>
</head>
<body>
   <div class="container">
      <div class="col-md-6 mx-auto text-center">
         <div class="header-title">
            <h1 class="wv-heading--title">
               <img src="assets/fawry.png">
            </h1>
         </div>
      </div>
      <div class="row">
         <div class="col-md-4 mx-auto">
            <div class="myform form ">
               <form method="post" action="server.php">
                  <div class="form-group">
                     <input type="number" name="code"  class="form-control my-input" placeholder="Code" required>
                  </div>
                  <div class="form-group">
                     <input type="number" name="price" class="form-control my-input" placeholder="Price" required>
                  </div>
                  <input type="hidden" name="user" value="12345">
                  <div class="text-center ">
                     <button type="submit" name="payment_user" class=" btn btn-block send-button tx-tfm">Submit</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</body>

<?php if($_GET['status'] == 'Paid'){
        echo '<script>
              document.addEventListener("DOMContentLoaded", function(event) {
                swal("Good", "You are now pay", "success");
              });
              </script>';
      }elseif($_GET['status'] == 'NoPayment'){
        echo '<script>
              document.addEventListener("DOMContentLoaded", function(event) {
                swal("Error", "The payment code appears to be incorrect", "error");
              });
              </script>';
      }elseif($_GET['status'] == 'AmountIncorrect'){
        echo '<script>
              document.addEventListener("DOMContentLoaded", function(event) {
                swal("Error", "The amount sent is incorrect", "error");
              });
              </script>';
      }elseif($_GET['status'] == 'PriceLow'){
        echo '<script>
              document.addEventListener("DOMContentLoaded", function(event) {
                swal("Error", "The price you will pay is less than required", "error");
              });
              </script>';
      }elseif($_GET['status'] == 'ErrorServiceProvider'){
        echo '<script>
              document.addEventListener("DOMContentLoaded", function(event) {
                swal("Error", "Error in calling service provider", "error");
              });
              </script>';
      }elseif($_GET['status'] == 'Error'){
        echo '<script>
              document.addEventListener("DOMContentLoaded", function(event) {
                swal("Error", "Payment error", "error");
              });
              </script>';
      }elseif($_GET['status'] == 'NoMoney'){
        echo "<script>
              document.addEventListener('DOMContentLoaded', function(event) {
                swal('Error', `You don't have money`, 'error');
              });
              </script>";
      }elseif($_GET['status'] == 'DataIncomplete'){
        echo '<script>
              document.addEventListener("DOMContentLoaded", function(event) {
                swal("Error", "The data is incomplete", "error");
              });
              </script>';
      } ?>
</html>
