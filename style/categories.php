<?php echo $this->header();
$category = $this->preparedQuery("SELECT * FROM categories WHERE id=?",array($_GET['categoryid']),'select_row'); ?>


<br><br><br><br><br><br>

<div class="col-12 text-center">
  <h1><?php echo $category['title']; ?></h1>
</div>

</div> <!-- End of the container -->

</div> <!-- End of Darken -->
</header> <!--End of Header! -->

<!-- Page Content -->
<div class="container my-5">

<!-- Section -->
<section>




  <div class="row">

    <!--First column-->
    <div class="col-12">

      <!-- Nav tabs -->
      <ul class="nav md-pills flex-center flex-wrap mx-0" role="tablist">
        <li class="nav-item">
          <a class="nav-link active font-weight-bold text-uppercase" data-toggle="tab" href="#javascript:void(0);" role="tab">Latest books</a>
        </li>
      </ul>

    </div>
    <!--First column-->

  </div>
  <!--First row-->

  <!--Tab panels-->
  <div class="tab-content mb-5">

    <!--Panel 1-->
    <div class="tab-pane fade show in active" id="panel31" role="tabpanel">

      <!-- Grid row -->
      <div class="container-fluid text-center">

        <div class="row">
          <?php $result = $this->preparedQuery("SELECT * FROM books WHERE category_id=? ORDER BY id DESC",array($_GET['categoryid']));
          while ($row = $result->fetch_array()){ ?>
            <div class="col-md-3" style="margin-top:12px;">
              <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px; height:350px;" align="center">
                 <a href="<?php echo 'book&bookid='.$row["id"]; ?>">
                  <img src="<?php echo 'upload/'.$row["cover_image"]; ?>" class="img-responsive" style="width: 60%;border-radius: 15px;" />
                 </a><br><br>
                 <h6 class="text-info"><a href="<?php echo 'book&bookid='.$row["id"]; ?>"><?php echo $row["title"]; ?></a></h6>
                 <h6 class="text-danger">Price: <?php echo $row["price"]; ?> EGP</h6>
                 <div class="row">
                  <div class="col-md-4">
                    <input type="text" name="quantity" id="<?php echo 'quantity'.$row["id"]; ?>" class="form-control" value="1" />
                  </div>
                  <div class="col-md-8">
                    <button type="button" name="add_to_cart" idproduct="<?php echo $row["id"]; ?>" id="<?php echo 'add_to_cart'.$row["id"]; ?>" class="btn btn-success form-control add_to_cart">Add to Cart</button>
                  </div>
                 </div>
                 <input type="hidden" name="hidden_name" id="<?php echo 'name'.$row["id"]; ?>" value="<?php echo $row["title"]; ?>" />
                 <input type="hidden" name="hidden_price" id="<?php echo 'price'.$row["id"]; ?>" value="<?php echo $row["title"]; ?>" />
              </div>
            </div>
            <?php } ?>
          </div>

      </div>
      <!-- Grid row -->

    </div>
    <!--Panel 1-->


    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="modal fade" id="bkcontent"> <!-- ID of Modal <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< -->
            <div class="modal-dialog modal-lg modal-md modal-sm">
              <div class="modal-content">
                <div class="modal-header justify-content-center">
                  <h2 class="text-center">Table of Contents</h2>
                </div>

                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-9">Abstract</div>
                    <div class="col-md-3">II</div>
                  </div>
                  <div class="row">
                    <div class="col-md-9">List of Figures</div>
                    <div class="col-md-3">III</div>
                  </div>
                  <div class="row font-weight-bold">
                    <div class="col-md-9"><span class="mr-1">1.</span> <span>Introduction</span></div>
                    <div class="col-md-3">1</div>
                  </div>
                  <div class="row">
                    <div class="col-md-9"><span>1.1</span> <span>Literature Review</span></div>
                    <div class="col-md-3">4</div>
                  </div>
                  <div class="row">
                    <div class="col-md-9"><span>1.2</span> <span>Main Argument</span></div>
                    <div class="col-md-3">6</div>
                  </div>
                  <div class="row font-weight-bold">
                    <div class="col-md-9"><span class="mr-1">2.</span> <span>Chapter 1</span></div>
                    <div class="col-md-3">10</div>
                  </div>
                  <div class="row">
                    <div class="col-md-9"><span>2.1</span> <span>Introduction</span></div>
                    <div class="col-md-3">10</div>
                  </div>
                  <div class="row">
                    <div class="col-md-9"><span>2.2</span> <span>Main Body</span></div>
                    <div class="col-md-3">12</div>
                  </div>
                  <div class="row">
                    <div class="col-md-9"><span>2.3</span> <span>Conclusion</span></div>
                    <div class="col-md-3">14</div>
                  </div>
                  <div class="row font-weight-bold">
                    <div class="col-md-9"><span class="mr-1">3.</span> <span>Chapter 2</span></div>
                    <div class="col-md-3">16</div>
                  </div>
                  <div class="row">
                    <div class="col-md-9"><span>3.1</span> <span>Introduction</span></div>
                    <div class="col-md-3">17</div>
                  </div>
                  <div class="row">
                    <div class="col-md-9"><span>3.2</span> <span>Main Body</span></div>
                    <div class="col-md-3">19</div>
                  </div>
                  <div class="row">
                    <div class="col-md-9"><span>3.3</span> <span>Conclusion</span></div>
                    <div class="col-md-3">21</div>
                  </div>
                  <div class="row font-weight-bold">
                    <div class="col-md-9"><span class="mr-1">4.</span> <span>Chapter 3</span></div>
                    <div class="col-md-3">22</div>
                  </div>
                  <div class="row">
                    <div class="col-md-9"><span>4.1</span> <span>Introduction</span></div>
                    <div class="col-md-3">23</div>
                  </div>
                  <div class="row">
                    <div class="col-md-9"><span>4.2</span> <span>Main Body</span></div>
                    <div class="col-md-3">25</div>
                  </div>
                  <div class="row">
                    <div class="col-md-9"><span>4.3</span> <span>Conclusion</span></div>
                    <div class="col-md-3">27</div>
                  </div>
                  <div class="row font-weight-bold">
                    <div class="col-md-9"><span class="mr-1">5.</span> <span>Conclusion</span></div>
                    <div class="col-md-3">29</div>
                  </div>
                  <div class="row">
                    <div class="col-md-9"><span></span> <span>References</span></div>
                    <div class="col-md-3">33</div>
                  </div>


                <div class="modal-footer">
                  <input type="text" class="btn btn-dark" data-dismiss="modal" value="Close">
                </div>
              </div>


            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!--Tab panels-->

</section>
<!-- Section -->

</div>


<!-- End of Page Content -->

<script>
$( function() {

  $('#all_book').click(function() {
    if($('#all_book').is(':checked')){
    $('#search_system').val('all_book');
   }
  });

  $('#book_name').click(function() {
    if($('#book_name').is(':checked')){
    $('#search_system').val('book_name');
   }
  });

  $('#isbn').click(function() {
   if($('#isbn').is(':checked')) {
    $('#search_system').val('isbn');
   }
  });

  $('#author').click(function() {
    if($('#author').is(':checked')){
     $('#search_system').val('author');
    }
  });

  $('#publisher').click(function() {
    if($('#publisher').is(':checked')){
    $('#search_system').val('publisher');
   }
  });


 $( "#search_input" ).autocomplete({
   search: function(e,ui){
     $(this).data("ui-autocomplete").menu.bindings = $();
   },
  source: function( request, response ) {
   // Fetch data
   $.ajax({
    url: "/include/ajax.php?get=search_book&search=" + $('#search_system').val(),
    type: 'post',
    dataType: "json",
    data: {
     search: request.term,
    },
    success: function( data ) {
     response( data );
    }
   });
  },
  select: function (event, ui) {
   // Set selection
   $('#search_input').val(ui.item.label); // display the selected text
   var url = '/book&bookid=';
   window.location.replace(url + ui.item.value);
   return false;
  },
 change: function (event, ui) {
   if (ui.item === null) {
    swal("Error!", "The book does not exist", "error");
    $(this).val('');
   }
 }
 });
});
</script>


<?php include("style/footer.php"); ?>
