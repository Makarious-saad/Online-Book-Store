<?php echo $this->header(); ?>

  <br><br><br><br><br><br>
  <div class="container">

    <h5 class="font-weight-light text-white text-lg-left mt-4 mb-0">Popular Books</h5>

    <hr class="mt-2">

    <div class="row text-center text-lg-left">

      <div class="col-lg-3 col-md-4 col-6">
        <a href="#" class="d-block mb-4 h-100">
              <img class="img-fluid img-thumbnail" src="style/assets/imgs/placeholder-400x300.jpg" alt="">
            </a>
      </div>
      <div class="col-lg-3 col-md-4 col-6">
        <a href="#" class="d-block mb-4 h-100">
              <img class="img-fluid img-thumbnail" src="style/assets/imgs/placeholder-400x300.jpg" alt="">
            </a>
      </div>
      <div class="col-lg-3 col-md-4 col-6">
        <a href="#" class="d-block mb-4 h-100">
              <img class="img-fluid img-thumbnail" src="style/assets/imgs/placeholder-400x300.jpg" alt="">
            </a>
      </div>
      <div class="col-lg-3 col-md-4 col-6">
        <a href="#" class="d-block mb-4 h-100">
              <img class="img-fluid img-thumbnail" src="style/assets/imgs/placeholder-400x300.jpg" alt="">
            </a>
      </div>
      <div class="col-lg-3 col-md-4 col-6">
        <a href="#" class="d-block mb-4 h-100">
              <img class="img-fluid img-thumbnail" src="style/assets/imgs/placeholder-400x300.jpg" alt="">
            </a>
      </div>
      <div class="col-lg-3 col-md-4 col-6">
        <a href="#" class="d-block mb-4 h-100">
              <img class="img-fluid img-thumbnail" src="style/assets/imgs/placeholder-400x300.jpg" alt="">
            </a>
      </div>
      <div class="col-lg-3 col-md-4 col-6">
        <a href="#" class="d-block mb-4 h-100">
              <img class="img-fluid img-thumbnail" src="style/assets/imgs/placeholder-400x300.jpg" alt="">
            </a>
      </div>
      <div class="col-lg-3 col-md-4 col-6">
        <a href="#" class="d-block mb-4 h-100">
              <img class="img-fluid img-thumbnail" src="style/assets/imgs/placeholder-400x300.jpg" alt="">
            </a>
      </div>
    </div>

  </div>
  <!-- /.container -->



<script>
$(function () {
var selectedClass = "";
$(".filter").click(function () {
selectedClass = $(this).attr("data-rel");
$("#gallery").fadeTo(100, 0.1);
$("#gallery div").not("." + selectedClass).fadeOut().removeClass('animation');
setTimeout(function () {
$("." + selectedClass).fadeIn().addClass('animation');
$("#gallery").fadeTo(300, 1);
}, 300);
});
});
</script>

<?php include("style/footer.php"); ?>
