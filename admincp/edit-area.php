<!DOCTYPE html>
<html>

<head>
  <title>Edit Area</title>
  <?php include('head.php'); ?>
</head>

<body id="page-top">
  <div id="wrapper">

    <?php include('navbar.php');
          $resultEdit = $systemData->preparedQuery("SELECT * FROM areas WHERE id=?",array($_GET['id']));
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
        <form action="../include/check.php" method="post">
          <div class="container-fluid">
              <h2 class="text-monospace">Edit Area</h2>
              <div class="Push-20"></div>

              <div class="row">
                <div class="col-4">
                  <div class="card">
                    <div class="card-body">
                      <label>City</label>
                      <div class="Push-20"></div>
                      <div class="form-group">
                        <select class="form-control" name="city" required>
                          <option selected disabled>Select city</option>

                          <?php $result = $systemData->preparedQuery("SELECT * FROM cities ORDER BY id DESC");
                                while ($row = $result->fetch_array()){
                                  $sel = '';
                                  if($row['id'] == $rowEdit['city_id']) $sel = 'selected';
                                  echo '<option value="'.$row['id'].'" '.$sel.'>'.$row['name'].'</option>';
                                } ?>

                        </select>
                      </div>

                    </div>
                  </div>
                </div>

                <div class="col-4">
                  <div class="card">
                    <div class="card-body" style="width: 300px;">
                      <label>Area Name</label>
                      <div class="Push-20"></div>
                      <input type="text" name="name" class="border rounded-0 form-control-lg" required value="<?php echo $rowEdit['name']; ?>" style="width: 161%;" placeholder="Area Name">
                    </div>
                  </div>
                </div>

                <div class="col-4">
                  <div class="card">
                    <div class="card-body" style="width: 300px;">
                      <label>Shipping Fee</label>
                      <div class="Push-20"></div>
                      <input type="number" name="shipping_fee" class="border rounded-0 form-control-lg" required value="<?php echo $rowEdit['shipping_fee']; ?>" style="width: 161%;" placeholder="Shipping Fee">
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12 offset-3 offset-md-4 offset-lg-5 offset-xl-5">
                  <div class="Push-20"></div>
                  <input type="hidden" name="id" value="<?php echo $rowEdit['id']; ?>">
                  <button type="submit" name="edit-area" class="btn btn-success btn-lg text-center">Update</button>
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
