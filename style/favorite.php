<?php echo $this->header();
if(empty($_SESSION['wishlist']))
  $_SESSION['wishlist'] = array(); ?>

<br><br><br><br><br><br>
<div class="row justify-content-center">
  <div class="col-12" >
    <div class="emailentry">
      <h3 class="text-white display-5">My favorite</h3>

          <div class="table-responsive" id="order_table">
           <table class="table table-bordered table-striped" style="background-color: white;">
             <thead>
                <tr>
                    <th class="text-center">Book name</th>
                    <th class="text-center">Description book</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Remove</th>
                </tr>
              </thead>
              <tbody>
        <?php foreach($_SESSION['wishlist'] as $bookID) {
                  $book = $this->preparedQuery("SELECT * FROM books WHERE id=?",array($bookID),'select_row'); ?>

                 <tr>
                  <td align="center"><?php echo $book["title"]; ?></td>
                  <td align="center"><?php echo mb_strimwidth($book["description"], 0, 50, "..."); ?></td>
                  <td align="center"><?php echo $book["price"].' EGP'; ?></td>
                  <td align="center"><button type="button" id="delete_from_favorite" idproduct="<?php echo $book["id"]; ?>" class="btn btn-danger form-control">Remove</button></td>
                 </tr>

        <?php  }if(empty($_SESSION['wishlist'])){ ?>

          <tr>
           <td colspan="4" align="center">
             There are no products in the wishlist
           </td>
          </tr>

      <?php  }else{ ?>
          <tr>
           <td colspan="4" align="center">
             <div class="col-3 text-center">
               <button type="button" id="empty_favorite_list" class="btn btn-primary form-control">Empty my favorite list</button>
             </div>
           </td>
          </tr>

        <?php } ?>

              </tbody>
              </table>
            </div>




    </div>
  </div>
</div>

<?php include("style/footer.php"); ?>
