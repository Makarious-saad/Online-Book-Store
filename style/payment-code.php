<?php echo $this->header(); ?>

<br><br><br><br><br><br>
<div class="container text-center mt-2 mx-auto ">
  <label class=" text-white text-center h3">
      Please transfer the money to this Code in Fawry <img src="style/assets/imgs/fawrypay.png" style="width:120px;">
      <i class="fas fa-arrow-down"></i>
  </label>
    <p class="display-4 alert alert-dark middle"> <?php echo '#'.$_SESSION['CodePayment']; ?> </p>

    <div class="alert alert-info text-center">You can view the order status from here <a href="/orders">My Orders</a></div>

</div>
<!-- End of the container -->

<?php include("style/footer.php");
      $_SESSION['CodePayment'] = NULL; ?>
