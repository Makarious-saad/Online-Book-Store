<!DOCTYPE html>
<html>

<head>
  <title>Add New Publisher</title>
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
        <form action="../include/check.php" method="post">
          <div class="container-fluid">
              <h2 class="text-monospace">Add New Publisher</h2>
              <div class="Push-20"></div>

              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body" style="width: 300px;">
                      <label>Publisher Name</label>
                      <div class="Push-20"></div>
                      <input type="text" name="name" class="border rounded-0 form-control-lg" required style="width: 161%;" placeholder="Publisher Name">
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12 offset-3 offset-md-4 offset-lg-5 offset-xl-5">
                  <div class="Push-20"></div>
                  <button type="submit" name="new-publisher" class="btn btn-success btn-lg text-center">Submit</button>
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
