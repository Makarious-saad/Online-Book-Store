<!DOCTYPE html>
<html>

<head>
  <title>View Resale</title>
  <?php include('head.php'); ?>
</head>

<?php // Notifications
      if(@$_GET['success'] == 'status'){
        $systemData->swal('Good','The area was added successfully','success');
      }if(@$_GET['error'] == 'status'){
        $systemData->swal('Error!','An error in changing the order of orders','error');
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
                <h3 class="text-dark mb-4"><strong>View Resale</strong></h3>
                <div class="card shadow">
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
                                        <th class="text-center">ISBN</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Shipping Address</th>
                                        <th class="text-center">Payment status</th>
                                        <th class="text-center">Shipping status</th>
                                        <th class="text-center">Order status</th>
                                        <th class="text-center">Order shipping</th>
                                        <th class="text-center">Order accepted</th>
                                        <th class="text-center">Order rejected</th>
                                    </tr>
                                </thead>
                                <tbody>

                            <?php $result = $systemData->preparedQuery("SELECT * FROM orders WHERE resale_book > 0 ORDER BY id DESC");
                                  while ($row = $result->fetch_array()){
                                    $paymentCode = '-';
                                    $paymentStatus = '-';
                                    $address = $systemData->preparedQuery("SELECT * FROM addresses WHERE id=?",array($row['address_id']),'select_row');
                                    $area = $systemData->preparedQuery("SELECT * FROM areas WHERE id=?",array($address['area_id']),'select_row');
                                    $city = $systemData->preparedQuery("SELECT name FROM cities WHERE id=?",array($area['city_id']),'select_row')['name'];
                                    $shipment = $systemData->preparedQuery("SELECT status FROM shipment WHERE order_id=?",array($row['id']),'select_row')['status'];
                                    $isbn = $systemData->preparedQuery("SELECT isbn FROM books WHERE id=?",array($row['resale_book']),'select_row')['isbn']; ?>

                                    <tr>
                                        <td class="align-middle text-center"><?php echo '#'.$isbn; ?></td>
                                        <td class="align-middle text-center"><?php echo $row['total_price'].' EGP'; ?></td>
                                        <td class="align-middle text-center"><?php echo $address['street_st']. ' - '.$area['name'].' - '.$city; ?></td>
                                        <td class="align-middle text-center text-primary"><?php echo $paymentStatus; ?></td>
                                        <td class="align-middle text-center text-primary"><?php echo ucfirst($shipment); ?></td>
                                        <td class="align-middle text-center text-primary"><?php echo ucfirst($row['status']); ?></td>

                                        <td class="align-middle text-center">
                                          <?php if($shipment == 'pending' && $row['status'] == 'approved'){ ?>
                                            <a class="btn btn-success" role="button" href="../include/check.php?order=received&id=<?php echo $row['id']; ?>">Received</a>
                                          <?php } ?>
                                        </td>
                                        <td class="align-middle text-center">
                                          <?php if($row['status'] == 'pending'){ ?>
                                            <a class="btn btn-success" role="button" href="../include/check.php?order=approval&id=<?php echo $row['id']; ?>">Approval</a>
                                          <?php } ?>
                                        </td>
                                        <td class="align-middle text-center">
                                          <?php if($row['status'] !== 'rejection' && $row['status'] == 'pending'){ ?>
                                            <a class="btn btn-danger" role="button" href="../include/check.php?order=rejection&id=<?php echo $row['id']; ?>">Rejection</a>
                                          <?php } ?>
                                        </td>
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
