<!DOCTYPE html>
<html>

<head>
  <title>View Users</title>
  <?php include('head.php'); ?>
</head>

<?php // Notifications
      if(@$_GET['error'] == 'add'){
        $systemData->swal('Error!','The user has not been added','error');
      }elseif(@$_GET['error'] == 'update'){
        $systemData->swal('Error!','The user has not been updated','error');
      }if(@$_GET['success'] == 'add'){
        $systemData->swal('Good','The user has been added successfully','success');
      }elseif(@$_GET['success'] == 'update'){
        $systemData->swal('Good','The user was successfully updated','success');
      }elseif(@$_GET['success'] == 'delete'){
        $systemData->swal('Good','The user has been deleted successfully','success');
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
                <h3 class="text-dark mb-4"><strong>View Users</strong></h3>
                <div class="card shadow">
                    <div class="card-header py-3">
                      <a class="btn btn-info float-right" role="button" href="/admincp/new-user">Add new user</a>
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
                                        <th class="text-center">#ID</th>
                                        <th class="text-center">First name</th>
                                        <th class="text-center">Last name</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Phone</th>
                                        <th class="text-center">Type</th>
                                        <th class="text-center">Edit User</th>
                                        <th class="text-center">Delete User</th>
                                    </tr>
                                </thead>
                                <tbody>

                            <?php $result = $systemData->preparedQuery("SELECT * FROM users WHERE account_type=? ORDER BY id DESC",array('user'));
                                  while ($row = $result->fetch_array()){ ?>

                                    <tr>
                                        <td class="text-center">#<?php echo $row['id']; ?></td>
                                        <td class="text-center"><?php echo $row['first_name']; ?></td>
                                        <td class="text-center"><?php echo $row['last_name']; ?></td>
                                        <td class="text-center"><?php echo $row['email']; ?></td>
                                        <td class="text-center"><?php echo $row['phone']; ?></td>
                                        <td class="text-center"><?php echo $row['type']; ?></td>
                                        <td class="text-center"><a class="btn btn-success" role="button" href="edit-user?id=<?php echo $row['id']; ?>">Edit</a></td>
                                        <td class="text-center"><a class="btn btn-danger" role="button" href="../include/check.php?user=<?php echo $row['id']; ?>">Delete</a></td>
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
