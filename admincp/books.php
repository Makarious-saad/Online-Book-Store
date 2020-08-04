<!DOCTYPE html>
<html>

<head>
  <title>View Books</title>
  <?php include('head.php'); ?>
</head>

<?php // Notifications
      if(@$_GET['error'] == 'add'){
        $systemData->swal('Error!','The book has not been added','error');
      }elseif(@$_GET['error'] == 'update'){
        $systemData->swal('Error!','The book has not been updated','error');
      }elseif(@$_GET['error'] == 'duplicate'){
        $systemData->swal('Error!','This book is a duplicate that you cannot enter again','error');
      }if(@$_GET['success'] == 'add'){
        $systemData->swal('Good','The book has been added successfully','success');
      }elseif(@$_GET['success'] == 'update'){
        $systemData->swal('Good','The book was successfully updated','success');
      }elseif(@$_GET['success'] == 'delete'){
        $systemData->swal('Good','The book has been deleted successfully','success');
      } ?>


<body id="page-top">
  <div id="wrapper">
    <?php include('navbar.php'); ?>
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                    <form class="form-inline d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <div class="input-group-append"></div>
                        </div>
                    </form>
                </div>
            </nav>
            <div class="container-fluid">
                <h3 class="text-dark mb-4"><strong>View Books</strong></h3>
                <div class="card shadow">
                    <div class="card-header py-3">
                      <a class="btn btn-info float-right" role="button" href="/admincp/new-book">Add new book</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 text-nowrap">
                                <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-right dataTables_filter" id="dataTable_filter"><label></label></div>
                            </div>
                        </div>
                        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                            <table class="table dataTable my-0" id="dataTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">#ISBN</th>
                                        <th class="text-center">Book Title</th>
                                        <th class="text-center">Category</th>
                                        <th class="text-center">Author</th>
                                        <th class="text-center">Publisher</th>
                                        <th class="text-center">User</th>
                                        <th class="text-center">Date added</th>
                                        <th class="text-center">Edit Book</th>
                                        <th class="text-center">Delete Book</th>
                                    </tr>
                                </thead>
                                <tbody>

                            <?php $result = $systemData->preparedQuery("SELECT * FROM books ORDER BY created_at DESC");
                                  while ($row = $result->fetch_array()){
                                    $category = $systemData->preparedQuery("SELECT title FROM categories WHERE id=?",array($row['category_id']),'select_row')['title'];
                                    $author = $systemData->preparedQuery("SELECT name FROM authors WHERE id=?",array($row['author_id']),'select_row')['name'];
                                    $publisher = $systemData->preparedQuery("SELECT name FROM publishers WHERE id=?",array($row['publisher_id']),'select_row')['name'];
                                    $user = $systemData->preparedQuery("SELECT first_name FROM users WHERE id=?",array($row['user_id']),'select_row')['first_name']; ?>

                                    <tr>
                                        <td class="text-center">#<?php echo $row['isbn']; ?></td>
                                        <td class="text-center"><a href="../book&bookid=<?php echo $row['id']; ?>" target="_blank"><?php echo $row['title']; ?></a></td>
                                        <td class="text-center"><?php echo $category; ?></td>
                                        <td class="text-center"><?php echo $author; ?></td>
                                        <td class="text-center"><?php echo $publisher; ?></td>
                                        <td class="text-center"><?php echo $user; ?></td>
                                        <td class="text-center"><?php echo $row['created_at']; ?></td>
                                        <td class="text-center"><a class="btn btn-success" role="button" href="edit-book?id=<?php echo $row['id']; ?>">Edit</a></td>
                                        <td class="text-center"><a class="btn btn-danger" role="button" href="../include/check.php?book=<?php echo $row['id']; ?>">Delete</a></td>
                                    </tr>

                            <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('footer.php'); ?>
    </div>
    <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
  </div>
</body>

</html>
