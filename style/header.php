<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="style/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="style/assets/css/all.css">
  <link rel="stylesheet" href="style/assets/css/styles.css">
  <link rel="stylesheet" href="style/assets/css/c-style.css">

  <!--jquery-->
  <script type="text/javascript" src="style/assets/js/jquery-3.4.1.min.js"></script>
  <!--jquery UI-->
  <link rel="stylesheet" type="text/css" href="style/assets/css/jquery-ui.css">
  <script type="text/javascript" src="style/assets/js/jquery-ui.min.js"></script>
  <!-- sweetalert -->
  <script src="<?php $this->siteURL; ?>style/assets/js/sweetalert.min.js"></script>

  <title> <?php echo $this->siteName; ?></title>
</head>

<body>
<header class="cover">
    <div class="darken">
      <div class="container">

        <nav class="navbar navbar-expand-lg navbar-dark text-light">
          <a class="navbar-brand" href="./">
          <img src="style/assets/imgs/logo.png"width="60px" alt="E-store"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="./">Home</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Categories
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <?php $result = $this->preparedQuery("SELECT * FROM categories ORDER BY id DESC");
                        while ($row = $result->fetch_array()){
                          echo '<a class="dropdown-item" href="/categories&categoryid='.$row['id'].'">'.$row['title'].'</a>';
                        } ?>
                </div>
              </li>
            </ul>

        <?php $user = $this->preparedQuery("SELECT * FROM users WHERE email=?",array($_SESSION['login']),'select_row');
                 if($user['type'] == 'buyer'){ ?>
              <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                 <div id="navbar-cart" class="navbar-collapse collapse">
                  <ul class="nav navbar-nav">
                   <li>
                    <a id="cart-popover" class="btn" data-placement="bottom" title="Shopping Cart">
                     <span class="fa fa-shopping-cart"></span>
                     <span class="badge badge-secondary"></span>
                     <span class="total_price">0.00 EGP</span>
                    </a>
                   </li>
                  </ul>
                 </div>
                </div>
              </nav>
            <?php }  ?>


              <div id="popover_content_wrapper" style="display: none">
                <span id="cart_details"></span>
                <div align="right">
                   <a href="/shipping-info" class="btn btn-primary" id="check_out_cart">
                   <span class="glyphicon glyphicon-shopping-cart"></span> Check out
                   </a>
                   <a href="/card" class="btn btn-info">
                     <span class="fa fa-shopping-cart"></span> Cart
                   </a>
                   <a href="javascript:void(0);" class="btn btn-danger" id="clear_cart">
                     <span class="fa fa-remove"></span> Clear
                   </a>
                </div>
              </div>

        <?php  if(isset($_SESSION['login'])){
                 $user = $this->preparedQuery("SELECT * FROM users WHERE email=?",array($_SESSION['login']),'select_row');
                      if($user['account_type'] == 'admin'){ ?>
                        <a href="./admincp/home" class="btn btn-outline-light mx-2 my-sm-0">Control Panel</a>
                <?php }if($user['account_type'] == 'user'){ ?>
                  <a href="./dashboard" class="btn btn-outline-light mx-2 my-sm-0">Dashboard</a>
                <?php }  ?>
                <a href="./?&process=logout" class="btn btn-outline-light mx-2 my-sm-0">logout</a>
              <?php }else{ ?>
                <a href="login" class="btn btn-outline-light mx-2 my-sm-0">Login</a>
                <a href="registration" class="btn btn-outline-light mx-2 my-sm-0">Register</a>
              <?php } ?>

          </div><!-- End of Menu Items Conainer -->

        </nav> <!-- End of Navigation -->
