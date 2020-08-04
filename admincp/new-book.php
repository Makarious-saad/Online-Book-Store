<!DOCTYPE html>
<html>

<head>
  <title>Add New Book</title>
  <?php include('head.php'); ?>
</head>

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
        <form action="../include/check.php" method="post" enctype="multipart/form-data">
          <div class="container-fluid">
              <h2 class="text-monospace">Add New Book</h2>
              <div class="Push-20"></div>

              <div class="row">
                <div class="col-2">
                  <div class="card">
                    <div class="card-body">
                      <label>#ISBN</label>
                      <div class="Push-20"></div>
                      <input type="number" name="isbn" class="border rounded-0 form-control-lg" style="width: 100%;" required placeholder="#ISBN">
                    </div>
                  </div>
                </div>

                <div class="col-3">
                  <div class="card">
                    <div class="card-body">
                      <label>Title</label>
                      <div class="Push-20"></div>
                      <input type="text" name="title" class="border rounded-0 form-control-lg" required style="width: 100%;" placeholder="Title Book">
                    </div>
                  </div>
                </div>

                <div class="col-3">
                  <div class="card">
                    <div class="card-body">
                      <label>PDF</label>
                      <div class="Push-20"></div>
                      <input type="text" name="pdf" class="border rounded-0 form-control-lg" style="width: 100%;" placeholder="PDF">
                    </div>
                  </div>
                </div>

                <div class="col-4">
                  <div class="card">
                    <div class="card-body">
                      <label>Cover image</label>
                      <div class="Push-20"></div>
                      <input type="file" name="cover" class="border rounded-0 form-control-lg" style="width: auto;" required>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row mt-2">
                <div class="col-2">
                  <div class="card">
                    <div class="card-body">
                      <label>Category</label>
                      <div class="Push-20"></div>
                      <div class="form-group">
                        <select class="form-control" name="category" required>
                          <option selected disabled>Select category</option>

                          <?php $result = $systemData->preparedQuery("SELECT * FROM categories ORDER BY id DESC");
                                while ($row = $result->fetch_array()){
                                  echo '<option value="'.$row['id'].'">'.$row['title'].'</option>';
                                } ?>

                        </select>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-2">
                  <div class="card">
                    <div class="card-body">
                      <label>Author</label>
                      <div class="Push-20"></div>
                      <div class="form-group">
                        <select class="form-control" name="author" required>
                          <option selected disabled>Select author</option>

                          <?php $result = $systemData->preparedQuery("SELECT * FROM authors ORDER BY id DESC");
                                while ($row = $result->fetch_array()){
                                  echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                                } ?>

                        </select>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-2">
                  <div class="card">
                    <div class="card-body">
                      <label>Publisher</label>
                      <div class="Push-20"></div>
                      <div class="form-group">
                        <select class="form-control" name="publisher" required>
                          <option selected disabled>Select publisher</option>

                          <?php $result = $systemData->preparedQuery("SELECT * FROM publishers ORDER BY id DESC");
                                while ($row = $result->fetch_array()){
                                  echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                                } ?>

                        </select>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-2">
                  <div class="card">
                    <div class="card-body">
                      <label>Released</label>
                      <div class="Push-20"></div>
                      <input type="date" name="released" class="border rounded-0 form-control-lg" style="width: -webkit-fill-available;">
                    </div>
                  </div>
                </div>

                <div class="col-2">
                  <div class="card">
                    <div class="card-body">
                      <label>QTY</label>
                      <div class="Push-20"></div>
                      <input type="number" name="qty" class="border rounded-0 form-control-lg" value="0" style="width: 100%;" required placeholder="QTY">
                    </div>
                  </div>
                </div>

                <div class="col-2">
                  <div class="card">
                    <div class="card-body">
                      <label>Price</label>
                      <div class="Push-20"></div>
                      <input type="number" name="price" class="border rounded-0 form-control-lg" value="0" style="width: 100%;" required placeholder="Price">
                    </div>
                  </div>
                </div>

              </div>

              <div class="row mt-2">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body" >
                      <label>Description</label>
                      <div class="Push-20"></div>
                      <textarea class="form-control-lg" style="width: 100%;" name="description" required spellcheck="true" placeholder="Description"></textarea>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12 offset-3 offset-md-4 offset-lg-5 offset-xl-5">
                  <div class="Push-20"></div>
                  <button type="submit" name="new-book" class="btn btn-success btn-lg text-center">Submit</button>
                </div>
              </div>
          </div>
        </form>
      </div>
      <?php include('footer.php'); ?>
    </div>
    <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
  </div>
</body>

</html>
