
<!DOCTYPE html>
<html lang="en">

     <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">

        <title> <?php echo $this->siteName; ?> - login </title>
        <link rel="stylesheet" type="text/css" href="style/assets/css/bootstrap.css">

         <style>
             body{
                 background-image: url(style/assets/imgs/cover1-9.jpg);
                 background-repeat: no-repeat  ;
                 background-size: cover;
               }
         </style>
       <div id="eresult" style="color: red;"></div>
     </head>
<body>

    <div id="error"></div>
    <div class="container">

      <div class="col-sm-10" style="width: 430px; margin-left: 320px; margin-top: 100px;">
          <div class="jumbotron">
      <div class="form-group" style="margin-top: -50px;">
          <h2 style="margin-left: 100px;">
              Login
              </h2>
              </div>
      <hr>

    <form action="include/check.php" method="post">
    <div class="form-group input-group">
      <span class="input-group-addon">
        <span class="glyphicon glyphicon-user"></span>
      </span>
      <input id="email"  type="email" class="form-control" name="email" placeholder="Email..." required>
    </div>

    <div class="form-group input-group">
        <span class="input-group-addon">
          <span class="glyphicon glyphicon-lock"></span>
        </span>
        <input id="pass" type="password" class="form-control" name="password" placeholder="Enter Password..." required >
    </div>

    <div class="form-group">
        <label>
          <input type="checkbox">
          Keep me signed in
        </label>
    </div>
    <div class="form-group" >
        <button type="submit" class="btn btn-primary" style="width" name = "submit">Login</button>
    </div>
        <div class="form group" > Don't have an account?
            <a href="registration">Register</a>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="style/assets/js/jquery-3.4.1.min.js" type="text/javascript"></script>
  <script src="style/assets/js/bootstrap.min.js"></script>
    <script src="style/assets/js/sweetalert.min.js"> </script>


    <script type="text/javascript">
        $('form').submit(function () {
            var email = $("#email").val();
            var password = $("#pass").val();

            if (email == ''){
               swal("Error","Blank email","error");
                return false;
            }

            else if (email.length <= 5){
               swal("Error","email too short","error");
                // $("#uname").css("background-color:red");
                return false;
            }


            else if (password == ''){
               swal("Error","Blank Password","error");
               return false;
            }

            else if (password.length <= 8){
               swal("Error","Password too short","error");
                return false;
            }

        });
            </script>
</body>
</html>
