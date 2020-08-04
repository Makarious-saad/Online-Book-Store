<!DOCTYPE html>
<html>

<head>
  <title>Dashboard</title>
  <?php include('head.php'); ?>
</head>

<body id="page-top">
  <div id="wrapper">

    <?php include('navbar.php');
          $users = $systemData->preparedQuery("SELECT id FROM users WHERE account_type='user'",null,'num');
          $orders = $systemData->preparedQuery("SELECT id FROM orders",null,'num');
          $books = $systemData->preparedQuery("SELECT id FROM books",null,'num'); ?>

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
          <div class="container">
              <h3 class="text-dark mb-0">Dashboard</h3>
          </div>
          <div class="Push-20"></div>
          <div class="container">
              <div class="row">
                  <div class="col">
                    <div class="bg-info border rounded shadow" style="height: 100%;">
                      <h4 class="d-xl-flex justify-content-xl-center" style="color: #ffffff;margin-top: 5%;">Sales</h4>
                      <span class="d-xl-flex justify-content-around" style="margin-bottom: 5%;">
                        <i class="fa fa-shopping-cart d-inline-block float-left d-xl-flex" style="font-size: 40px;color: #ffffff;"></i>
                        <span class="d-xl-flex justify-content-center align-items-center align-content-center justify-content-xl-center align-items-xl-center" style="font-size: 20px;color: #ffffff;">
                          <strong><?php echo $orders; ?></strong>
                        </span>
                      </span>
                    </div>
                  </div>
                  <div class="col">
                    <div class="bg-danger border rounded shadow" style="height: 100%;">
                      <h4 class="d-xl-flex justify-content-xl-center" style="color: #ffffff;margin-top: 5%;">Users</h4>
                      <span class="d-xl-flex justify-content-around" style="margin-bottom: 5%;">
                        <i class="fa fa-users d-inline-block float-left d-xl-flex" style="font-size: 40px;color: #ffffff;"></i>
                        <span class="d-xl-flex justify-content-center align-items-center align-content-center justify-content-xl-center align-items-xl-center" style="font-size: 20px;color: #ffffff;">
                          <strong><?php echo $users; ?></strong>
                        </span>
                      </span>
                    </div>
                  </div>
                  <div class="col">
                    <div class="bg-primary border rounded shadow" style="height: 100%;">
                      <h4 class="d-xl-flex justify-content-xl-center" style="color: #ffffff;margin-top: 5%;">Books</h4>
                      <span class="d-xl-flex justify-content-around" style="margin-bottom: 5%;">
                        <i class="fa fa-book d-inline-block float-left d-xl-flex" style="font-size: 40px;color: #ffffff;"></i>
                        <span class="d-xl-flex justify-content-center align-items-center align-content-center justify-content-xl-center align-items-xl-center" style="font-size: 20px;color: #ffffff;">
                          <strong><?php echo $books; ?></strong>
                        </span>
                      </span>
                    </div>
                  </div>
                  <div class="col">
                    <div class="bg-warning border rounded shadow" style="height: 100%;">
                      <h4 class="d-xl-flex justify-content-xl-center" style="color: #ffffff;margin-top: 5%;">Traffic</h4>
                      <span class="d-xl-flex justify-content-around" style="margin-bottom: 5%;">
                        <i class="fa fa-user d-inline-block float-left d-xl-flex" style="font-size: 40px;color: #ffffff;"></i>
                        <span class="d-xl-flex justify-content-center align-items-center align-content-center justify-content-xl-center align-items-xl-center" style="font-size: 20px;color: #ffffff;">
                          <strong>0</strong>
                        </span>
                      </span>
                    </div>
                  </div>
              </div>
          </div>
          <div class="container-fluid">
              <div class="d-sm-flex justify-content-between align-items-center mb-4"></div>
              <div class="row">
                  <div class="col">
                      <div>
                          <div class="card">
                              <div class="card-body">
                                  <div class="table-responsive">
                                      <table class="table">
                                          <thead>
                                              <tr>
                                                  <th class="text-center border rounded-0" colspan="5">Latest Orders</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                  <td class="text-center" style="color: rgb(0,0,0);"><strong>Order ID</strong></td>
                                                  <td class="text-center" style="color: rgb(0,0,0);"><strong>Order type</strong></td>
                                                  <td class="text-center" style="color: rgb(0,0,0);"><strong>Area-City</strong></td>
                                                  <td class="text-center" style="color: rgb(0,0,0);"><strong>Price</strong></td>
                                                  <td class="text-center" style="color: rgb(0,0,0);"><strong>Status</strong></td>
                                              </tr>
                                              <?php $result = $systemData->preparedQuery("SELECT * FROM orders ORDER BY created_at DESC LIMIT 5");
                                                    while ($row = $result->fetch_array()){
                                                      $address = $systemData->preparedQuery("SELECT * FROM addresses WHERE id=?",array($row['address_id']),'select_row');
                                                      $area = $systemData->preparedQuery("SELECT * FROM areas WHERE id=?",array($address['area_id']),'select_row');
                                                      $city = $systemData->preparedQuery("SELECT name FROM cities WHERE id=?",array($area['city_id']),'select_row')['name'];

                                                      ($row['resale_book'] == 0) ? $orderType = '<a href="/admincp/orders">New order</a>' : $orderType = '<a href="/admincp/resale">Resale</a>'; ?>

                                              <tr>
                                                  <td class="text-center">#<?php echo $row['id']; ?></td>
                                                  <td class="text-center"><?php echo $orderType; ?></td>
                                                  <td class="text-center"><?php echo $address['street_st']. ' - '.$area['name'].' - '.$city; ?></td>
                                                  <td class="text-center"><?php echo $row['total_price']; ?></td>
                                                  <td class="text-center text-primary"><?php echo $row['status']; ?></td>
                                              </tr>

                                              <?php } ?>
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col">
                      <div>
                          <div class="card">
                              <div class="card-body">
                                  <div class="table-responsive">
                                      <table class="table">
                                          <thead>
                                              <tr>
                                                  <th class="text-center border rounded-0" colspan="5">Recently added Books</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                  <td class="text-center" style="color: rgb(0,0,0);"><strong>BookName</strong></td>
                                                  <td class="text-center" style="color: rgb(0,0,0);"><strong>Category</strong></td>
                                                  <td class="text-center" style="color: rgb(0,0,0);"><strong>Publisher</strong></td>
                                                  <td class="text-center" style="color: rgb(0,0,0);"><strong>Status</strong></td>
                                              </tr>
                                              <?php $result = $systemData->preparedQuery("SELECT * FROM books ORDER BY created_at DESC LIMIT 5");
                                                    while ($row = $result->fetch_array()){
                                                      $category = $systemData->preparedQuery("SELECT title FROM categories WHERE id=?",array($row['category_id']),'select_row')['title'];
                                                      $publisher = $systemData->preparedQuery("SELECT name FROM publishers WHERE id=?",array($row['publisher_id']),'select_row')['name']; ?>

                                               <tr>
                                                  <td class="text-center"><?php echo $row['title']; ?></td>
                                                  <td class="text-center"><?php echo $category; ?></td>
                                                  <td class="text-center"><?php echo $publisher; ?></td>
                                                  <td class="text-center text-success"><?php echo $row['status']; ?></td>
                                              </tr>

                                              <?php } ?>
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                          </div>
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
