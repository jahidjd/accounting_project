<?php 
include 'inc/header.php';
include 'inc/sidebar.php';
include 'inc/database.php';
$type=$_POST['search'];
 $q = "select * from account_heads where type='$type'";
 $data= $db->query($q);

 // print_r($data);
 // exit;

?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Starter Page</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Starter Page</li>
                            </ol>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                
                        <div class="card">
                            <div class="card-body">
                                <div style="margin-left:600px">
                                <form action="" method="post">
                                    <table>
                                        <tr>
                                          <td><input type="text" name="search" placeholder="search your account type" class="form-control" >
                                          </td>
                                  <td>
                                    <input value="Search" type="submit" class="btn btn-primary">
                                  </td>
                                </tr>
                                </table>
                                </form>
                                </div>

                                     <a href="account_heads_list.php" class="btn btn-bolck btn-success">Back</a>
                                    <table class="table table-bordered" id="table">
                                        <thead>
                                          <tr class="bg-info text-center">
                                             <th>SL</th>
                                             <th>Account Head Type</th>
                                             <th>Account Head Name</th>
                                             <th>Note</th>
                                             <th>Txn_Type</th>
                                             <th>Amount</th>
                                             <th>Date</th>
                                          </tr>
                                        </thead>
                                           <tbody>
                                          <tr>
                                             <?php
                                             $i = 0;
                                             // while ($t = $data->fetch_assoc()) {
                                             //    $p="select * from account_heads";
                                             //    $info = $db->query($p);
                                                while($f = $data->fetch_assoc()){
                                                    $id= $f['id'];

                                                     $p = "select * from transactions where account_head_id='$id'";
                                                     $t= $db->query($p)->fetch_assoc();
                                                                                                 
                                             ?>
                                                    <td><?php echo ++$i ?></td>
                                                      <td><?php echo $f['type'] ?></td>
                                                      <td><?php echo $f['name'] ?></td>
                                                  
                                                    <td><?php echo $t['note'] ?></td>
                                                    <td><?php echo $t['txn_type'] ?></td>
                                                    <td><?php echo $t['amount'] ?></td>
                                                    <td><?php echo $t['date'] ?></td>
                                                  </tr>
                                             <?php } //} ?>
                                        </tbody>
                                          </tr>
                                    </table>
                            </div>
                        </div>
                        <!-- contents goes here  -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">Anything you want</div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2021
          <a href="https://adminlte.io">AdminLTE.io</a>.</strong
        >
        All rights reserved.
      </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- <script src="jQuery-3.6.0.min.js"></script> -->
  </body>
</html>