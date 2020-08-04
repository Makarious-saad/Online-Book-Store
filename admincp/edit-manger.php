<!DOCTYPE html>
<html>

<head>
  <title>Edit Admin</title>
  <?php include('head.php'); ?>
</head>

<body id="page-top">
  <div id="wrapper">

    <?php include('navbar.php');
          $resultEdit = $systemData->preparedQuery("SELECT * FROM users WHERE id=?",array($_GET['id']));
          $rowEdit = $resultEdit->fetch_array(); ?>

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
              <h2 class="text-monospace">Edit Admin</h2>
              <div class="Push-20"></div>

              <div class="row">
                <div class="col-6">
                  <div class="card">
                    <div class="card-body">
                      <label>First Name</label>
                      <div class="Push-20"></div>
                      <input type="text" name="first_name" class="border rounded-0 form-control-lg" value="<?php echo $rowEdit['first_name']; ?>" required style="width: 100%;" placeholder="First Name">
                    </div>
                  </div>
                </div>

                <div class="col-6">
                  <div class="card">
                    <div class="card-body">
                      <label>Last Name</label>
                      <div class="Push-20"></div>
                      <input type="text" name="last_name" class="border rounded-0 form-control-lg" required value="<?php echo $rowEdit['last_name']; ?>" style="width: 100%;" placeholder="Last Name">
                    </div>
                  </div>
                </div>
              </div>

              <div class="row mt-2">
                <div class="col-4">
                  <div class="card">
                    <div class="card-body">
                      <label>Email</label>
                      <div class="Push-20"></div>
                      <input type="email" name="email" class="border rounded-0 form-control-lg" required value="<?php echo $rowEdit['email']; ?>" style="width: 100%;" placeholder="Email">
                    </div>
                  </div>
                </div>

                <div class="col-4">
                  <div class="card">
                    <div class="card-body">
                      <label>Password</label>
                      <div class="Push-20"></div>
                      <input type="password" name="password" class="border rounded-0 form-control-lg" style="width: 100%;" placeholder="Password">
                    </div>
                  </div>
                </div>

                <div class="col-4">
                  <div class="card">
                    <div class="card-body">
                      <label>phone</label>
                      <div class="Push-20"></div>
                      <input type="text" name="phone" class="border rounded-0 form-control-lg" required value="<?php echo $rowEdit['phone']; ?>" style="width: 100%;" placeholder="Phone">
                    </div>
                  </div>
                </div>
              </div>


              <div class="row">
                <div class="col-12 offset-3 offset-md-4 offset-lg-5 offset-xl-5">
                  <div class="Push-20"></div>
                  <input type="hidden" name="id" value="<?php echo $rowEdit['id']; ?>">
                  <button type="submit" name="edit-admin" class="btn btn-success btn-lg text-center">Update</button>
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
