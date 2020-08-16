<?php echo $this->header(); ?>

<br><br><br><br><br><br>
<div class="row justify-content-center">
  <div class="col-12" >
    <div class="emailentry">
      <h3 class="text-white display-5">Store</h3>

          <div class="table-responsive" id="order_table">
           <table class="table table-bordered table-striped" style="background-color: white;font-size: small;">
             <thead>
                <tr>
                  <th class="text-center">#ISBN</th>
                  <th class="text-center">Book Title</th>
                  <th class="text-center">Category</th>
                  <th class="text-center">Author</th>
                  <th class="text-center">Publisher</th>
                  <th class="text-center">Book status</th>
                  <th class="text-center">Date added</th>
                </tr>
              </thead>
              <tbody>
        <?php $result = $this->preparedQuery("SELECT * FROM books WHERE user_id=? ORDER BY created_at DESC",array($_SESSION['UserID']));
              $bookNum = $this->preparedQuery("SELECT * FROM books WHERE user_id=?",array($_SESSION['UserID']),'num');
              while ($row = $result->fetch_array()){
                $category = $this->preparedQuery("SELECT title FROM categories WHERE id=?",array($row['category_id']),'select_row')['title'];
                $author = $this->preparedQuery("SELECT name FROM authors WHERE id=?",array($row['author_id']),'select_row')['name'];
                $publisher = $this->preparedQuery("SELECT name FROM publishers WHERE id=?",array($row['publisher_id']),'select_row')['name'];
                $user = $this->preparedQuery("SELECT first_name FROM users WHERE id=?",array($row['user_id']),'select_row')['first_name'];

                if($row['status'] == 'approval'){
                  $bookStatus = 'Approval';
                }elseif($row['status'] == 'enable'){
                  $bookStatus = 'For Sale';
                }elseif($row['status'] == 'pending'){
                  $bookStatus = 'Reviewing';
                }elseif($row['status'] == 'receiving'){
                  $bookStatus = 'Receiving';
                }elseif($row['status'] == 'disabled'){
                  $bookStatus = 'Sold';
                }elseif($row['status'] == 'rejection'){
                  $bookStatus = 'Rejection';
                }    ?>

                 <tr>
                   <td class="text-center">#<?php echo $row['id']; ?></td>
                   <td class="text-center"><a href="/book&bookid=<?php echo $row['id']; ?>" target="_blank"><?php echo $row['title']; ?></a></td>
                   <td class="text-center"><?php echo $category; ?></td>
                   <td class="text-center"><?php echo $author; ?></td>
                   <td class="text-center"><?php echo $publisher; ?></td>
                   <td class="text-center"><?php echo $bookStatus; ?></td>
                   <td class="text-center"><?php echo $row['created_at']; ?></td>
                 </tr>

        <?php  }if($bookNum == 0){ ?>
                <tr>
                 <td colspan="7" align="center">
                   There are no books you added
                 </td>
                </tr>
        <?php  } ?>

              </tbody>
              </table>
            </div>




    </div>
  </div>
</div> <!--End of Register -->

<?php include("style/footer.php"); ?>
