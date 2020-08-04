<?php echo $this->header(); ?>


<span id="cart_page"></span>

<?php include("style/footer.php"); ?>

<script>
$.ajax({
  url:"/include/fetch_cart.php",
  method:"POST",
  dataType:"json",
  success:function(data)
  {
    $('#cart_page').html(data.cart_details);
  }
});
</script>
