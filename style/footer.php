<?php if(!$_GET['page'] == ''){ ?>
  </div> <!-- End of the container -->

  </div> <!-- End of Darken -->
  </header> <!--End of Header! -->
<?php } ?>


  <!-- Footer -->

<footer class="page-footer font-small">


  <!-- Footer Links -->
  <div class="container text-center text-md-left mt-5">

    <!-- Grid row -->
    <div class="row mt-3">

      <!-- Grid column -->
      <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">

        <!-- Content -->
        <h6 class="text-uppercase font-weight-bold">E-Store</h6>
        <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>E-store is a website for reselling Books.</p>

      </div>
      <!-- Grid column -->
      <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">

        <!-- Links -->
        <h6 class="text-uppercase font-weight-bold">Category</h6>
        <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <?php $result = $this->preparedQuery("SELECT * FROM categories");
              while ($row = $result->fetch_array()){ ?>
                <p>
                  <a href="#!"><?php echo $row['title']; ?></a>
                </p>
        <?php } ?>


      </div>

      <!-- Grid column -->
      <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

        <!-- Links -->
        <h6 class="text-uppercase font-weight-bold">Contact</h6>
        <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          <i class="fas fa-envelope mr-3"></i> info@estore.com</p>
        <p>
          <i class="fas fa-phone mr-3"></i> +2 000 000000</p>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2019-2020 Copyright:
    <a href="#!"> E-store</a>
  </div>
  <!-- Copyright -->

</footer>
  <!-- End of  Footer -->


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.0.4/popper.js"></script>
  <script src="style/assets/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
  <script src="style/assets/js/all.js"></script>
  <script type="text/javascript" src="style/assets/js/everi.js"></script>





  <script>
  $(document).ready(function(){

    $(document).on('click', '#add_to_favorites', function(){
      var product_id = $(this).attr("idproduct");
        $.ajax({
          url:"/include/wishlist.php",
          method:"POST",
          data:{action:'add',product_id:product_id},
          success:function(data){
            swal("Good", "The product has been added to the wish list", "success");
          }
        });
    });

    $(document).on('click', '#delete_from_favorite', function(){
      var product_id = $(this).attr("idproduct");
        $.ajax({
          url:"/include/wishlist.php",
          method:"POST",
          data:{action:'delete_once',product_id:product_id},
          success:function(data){
            location.reload();
          }
        });
    });

    $(document).on('click', '#empty_favorite_list', function(){
        $.ajax({
          url:"/include/wishlist.php",
          method:"POST",
          data:{action:'delete_all'},
          success:function(data){
            location.reload();
          }
        });
    });

  	load_product();

  	load_cart_data();

  	function load_product()
  	{
  		$.ajax({
  			url:"/include/fetch_item.php",
  			method:"POST",
  			success:function(data)
  			{
  				$('#display_item').html(data);
  			}
  		});
  	}

  	function load_cart_data()
  	{
  		$.ajax({
  			url:"/include/fetch_cart.php",
  			method:"POST",
  			dataType:"json",
  			success:function(data)
  			{
  				$('#cart_details').html(data.cart_details);
  				$('.total_price').text(data.total_price);
  				$('.badge').text(data.total_item);
  			}
  		});
  	}


    $(function() {
    	$('#cart-popover').popover({
        html:true,
        container: 'body',
        content:function(){
        	return $('#popover_content_wrapper').html();
        }
      })
      .on('shown.bs.popover', function () {
        $('#table').bootstrapTable();
      });
    });

    <?php $resultProductID = $this->preparedQuery("SELECT id FROM books ORDER BY id DESC");
    while ($rowProductID = $resultProductID->fetch_array()){ ?>

    	$(document).on('click', '<?php echo '#add_to_cart'.$rowProductID["id"]; ?>', function(){

    		var product_id = $(this).attr("idproduct");
    		var product_name = $('#name'+product_id+'').val();
    		var product_price = $('#price'+product_id+'').val();
    		var product_quantity = $('#quantity'+product_id).val();
    		var action = "add";
    		if(product_quantity > 0){
    			$.ajax({
    				url:"/include/action.php",
    				method:"POST",
    				data:{product_id:product_id, product_name:product_name, product_price:product_price, product_quantity:product_quantity, action:action},
    				success:function(data){
              if("<?php echo $_SESSION['login'] ?>" !== ""){
                load_cart_data();
                swal("Good", "Item has been Added into Cart", "success");
              }else{
                swal("Error!", "Log in to be able to add products to the cart", "error");
              }
    				}
    			});
    		}else{
          swal("Error!", "lease Enter Number of Quantity", "error");
    		}
    	});

    <?php } ?>

  	$(document).on('click', '.delete', function(){
  		var product_id = $(this).attr("id");
  		var action = 'remove';
  		if(confirm("Are you sure you want to remove this product?"))
  		{
  			$.ajax({
  				url:"/include/action.php",
  				method:"POST",
  				data:{product_id:product_id, action:action},
  				success:function()
  				{
  					load_cart_data();
  					$('#cart-popover').popover('hide');
            location.reload();
  				}
  			})
  		}
  		else
  		{
  			return false;
  		}
  	});

  	$(document).on('click', '#clear_cart', function(){
  		var action = 'empty';
  		$.ajax({
  			url:"/include/action.php",
  			method:"POST",
  			data:{action:action},
  			success:function()
  			{
  				load_cart_data();
  				$('#cart-popover').popover('hide');
          swal("Good", "Your Cart has been clear", "success");
  			}
  		});
  	});

  });

  </script>


</body>

</html>
