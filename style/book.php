<?php echo $this->header();
$book = $this->preparedQuery("SELECT books.id,books.title,books.description,books.released,books.price,books.cover_image,categories.title AS categories_title,authors.name AS author_name,publishers.name AS publisher_name
                              FROM books books, authors authors, categories categories, publishers publishers
                              WHERE books.category_id=categories.id AND books.author_id=authors.id AND books.publisher_id=publishers.id AND books.id=?",array($_GET['bookid']),'select_row'); ?>

        <!-- Page Content -->
  <div class="container">

    <h5 class="font-weight-light text-white text-lg-left mt-4 mb-0"><?php echo $book['title']; ?></h5>

    <hr class="mt-2">


    <!--Tab panels-->
    <div class="tab-content mb-5">

      <!--Panel 1-->
      <div class="tab-pane fade show in active" id="panel31" role="tabpanel">

        <!-- Grid row -->
        <div class="row">

          <!-- Grid column -->
          <div class="col-md-12 col-lg-12">

            <!-- Card -->
            <a class="card hoverable mb-4" data-toggle="modal" data-target="#basicExampleModal">

              <!-- Card image -->
              <div class="row">
                <div class="col-md-6 col-lg-4">
                  <img class="card-img-top" style="height: 346px;" src="upload/<?php echo $book['cover_image']; ?>" alt="Card image cap">
                </div>
                <div class="col-md-6 col-lg-7 text-center">
                  <br>
                  <b><?php echo $book['title']; ?></b>
                  <br><br>
                  <p style="font-size: small;"><?php echo $book['description']; ?></p>


                  <p class="card-text mb-3">Category: <?php echo $book['categories_title']; ?></p><?php  ?>

                  <p class="card-text mb-3">Author: <?php echo $book['author_name']; ?></p>

                  <p class="card-text mb-3">Publisher: <?php echo $book['publisher_name']; ?></p>

                  <p class="card-text mb-3">Released: <?php echo $book['released']; ?></p>

                  <p class="card-text mb-3">Price: <?php echo $book['price']; ?> EGP</p>

                </div>
                <div class="col-6">
                  <div class="row m-2">
                    <div class="col-2">
                      <input type="text" name="quantity" id="<?php echo 'quantity'.$book["id"]; ?>" class="form-control" value="1" />
                    </div>
                    <div class="col-4">
                      <button type="button" name="add_to_cart" idproduct="<?php echo $book["id"]; ?>" id="<?php echo 'add_to_cart'.$book["id"]; ?>" class="btn btn-success form-control add_to_cart">Add to Cart</button>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="row float-right m-2">
                    <div class="col-12">
                      <button type="button" idproduct="<?php echo $book['id']; ?>" id="add_to_favorites" class="btn btn-primary form-control">Add to favorites</button>
                    </div>
                  </div>
                </div>
              </div>
              <input type="hidden" id="<?php echo 'name'.$book['id']; ?>" value="<?php echo $book["title"]; ?>" />
              <input type="hidden" id="<?php echo 'price'.$book['id']; ?>" value="<?php echo $book["price"]; ?>" />


            </a>
            <!-- Card -->

          </div>
          <!-- Grid column -->

        </div>
        <!-- Grid row -->

      </div>
      <!--Panel 1-->

    </div>
    <!--Tab panels-->

  </div>
  <!-- /.container -->




<?php include("style/footer.php"); ?>
