<br><br><br><br><br><br>
<div class="row justify-content-center"> <!-- Search Bar -->
  <div class="col-8">
    <div class="searchbooks">
      <h1 class="text-white text-center">Looking for a Book?</h1>
      <form action="/search" method="post">
        <div class="row">
          <div class="col-8">
            <input id="search_input" type="text" name="search_input" required class="form-control form-control-lg" placeholder="Search">
            <input id="search_system" type="hidden" value="all_book">
          </div>

          <div class="col-4">
            <a class="btn form-control-lg btn-outline-light mx-2 my-sm-0" data-toggle="collapse" href="#advancedsearch" role="button" style="padding-top:12px;height:49px;" aria-expanded="false" aria-controls="advancedsearch">Advanced Search</a>
          </div>

          <div class="col-12 mt-2">
            <div class="collapse multi-collapse" id="advancedsearch">
                <div class="card card-body bg-transparent text-white">
                  <div class="container">
                    <span class="text-white mx-3 mt-3">You can search by:</span>
                    <input type="radio" id="all_book" checked name="search" value="all_book" style="display:none;">
                    <label class="radio-inline mx-1 text-white">
                      <input type="radio" id="book_name" name="search" value="book_name"> Book name
                    </label>
                    <label class="radio-inline mx-1 text-white">
                      <input type="radio" id="author" name="search" value="author"> Author
                    </label>
                    <label class="radio-inline mx-1 text-white">
                      <input type="radio" id="publisher" name="search" value="publisher"> Publisher
                    </label>
                    <label class="radio-inline mx-1 text-white">
                      <input type="radio" id="isbn" name="search" value="isbn"> ISBN #
                    </label>
                  </div>
              </div>
            </div>
          </div>
        </div>

      </form>
    </div>
  </div>
</div><!--End of Search Bar -->

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

        <div id="display_item"></div>

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
   /*if (ui.item === null) {
    swal("Error!", "The book does not exist", "error");
    $(this).val('');
  }*/
 }
 });
});
</script>
