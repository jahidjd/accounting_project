<?php 
include 'inc/header.php';
include 'inc/sidebar.php';
$q="select assets.*, transactions.txn_type from assets join transactions on transactions.id=assets.txn_id where type='fixed'";
$data=$db->query($q);

$p="select assets.*, transactions.txn_type from assets join transactions on transactions.id=assets.txn_id where type='current'";
$info=$db->query($p);
?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Trial Balance</h1>
                        </div>
                        <!-- /.col -->
                        
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- contents goes here  -->

                        <?php
                       
                        $fixed=0;
                        $dep=0;
                          
                             while($m = $data->fetch_assoc()){
                                 if($m['txn_type']=='debit'){
                                     $fixed+=$m['amount'] ;
                                 }else{
                                    $fixed-=$m['amount'] ;
                                 }
                                           //$total+=$m['amount']-(($m['amount']*$m['depreciation_rate'])/100) ;
                                           $dep+=(($m['amount']*$m['depreciation_rate'])/100);
                                           
                                       } 
                                          

                          $total_current=0;
                         
                        
                             while($k = $info->fetch_assoc()){
                                 if($k['txn_type']=='debit'){
                                     $total_current+=$k['amount'] ;
                                 }else{
                                    $total_current-=$k['amount'] ;
                                 }
                                           
                                           
                                       } 
                                           ?>      
                       
                           <table class="table table-bordered">
                               <thead>
                             <tr class="bg-info">
                                <th>Description</th>
                                
                                <th>Sub Total</th>
                                <th>Total</th>
                             </tr>
                             </thead>
                               <tbody>
                                       <tr>
                                           <td >Asset
                                               <br>
                                               Fixed=<?php echo $fixed ?>
                                               <br>
                                              (-) Depreciation=<?php echo $dep ?>
                                              <br>
                                              <br> <br>
                                              Current
                                             
                                           </td>
                                           <td align="right"><?php echo number_format($fixed-$dep,2); ?> <br> <br> <br> <br>
                                           <?php echo number_format($total_current,2) ?></td>
                                         
                                           
                                           
                                          
                                       </tr>
                                       <tr>
                                           <td align="right"><strong>Total Asset</strong></td>
                                           <td></td>
                                           <td align="right"><strong><?php echo  number_format($total_current+($fixed-$dep),2)?></strong></td>
                                       </tr>
<!-- Arif Vai  start-->
<?php 
        $inc=$db->query('select * from income');
        $ali=0;
        while($income=$inc->fetch_assoc()){
            $ss=$db->query("select sum(amount) as t_income from income");
            $uu=$ss->fetch_assoc();
            $ali=$ali+$uu['t_income'];
        };
?>

 <?php

        $exp=$db->query('select * from expense');
        $raju=0;
        while($expense=$exp->fetch_assoc()){
            $sss=$db->query("select sum(amount) as t_expense from expense");
            $uuu=$sss->fetch_assoc();
            $ali=$raju+$uuu['t_expense'];
        };
        $profit=$uu['t_income']-$uuu['t_expense'];

?>
<?php
        $capital=0;
        $withdraw=0;
        $cap=$db->query("select sum(equity.amount) as amount ,transactions.txn_type  from equity join transactions on transactions.id=equity.txn_id where txn_type='debit'")->fetch_assoc();

        if(isset($cap['amount'])){
            $capital=$cap['amount'];
        }

        $withd=$db->query("select sum(equity.amount) as amount,transactions.txn_type  from equity join transactions on transactions.id=equity.txn_id where txn_type='credit'")->fetch_assoc();
        if(isset($withd['amount'])){
            $withdraw=$withd['amount'];
        }

        // Liability Query
        $ldebit="select sum(liability.amount) as debitAmount from liability join transactions on transactions.id = liability.txn_id where transactions.txn_type='debit'";
        $ldebitData=$db->query($ldebit)->fetch_assoc();

        $lcredit="select sum(liability.amount) as creditAmount from liability join transactions on transactions.id = liability.txn_id where transactions.txn_type='credit'";
        $lcreditData=$db->query($lcredit)->fetch_assoc();
?>
                                       <tr>
                                            <td>Owner's Equity</td>
                                            <td align="right">
                                                <strong>
                                            <?php
                                        $t_equity=$capital+ $uu['t_income']-$uuu['t_expense']-$withdraw;
                                        echo number_format($t_equity,2);
                                        ?>
                                                </strong>
                                            </td>
                                            <td></td>
                                        </tr>
                                         <tr>
                                            <td>Liability</td>
                                            <td align="right">
                                                <strong>
                                         <?php
                                        $liability= $ldebitData['debitAmount']-$lcreditData['creditAmount'];
                                        echo number_format($liability,2);
                                        ?>
                                                </strong>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><strong>Total Liability</strong></td>
                                            <td></td>
                                            <td align="right"><strong><?php echo number_format($t_equity+$liability,2);?></strong></td>
                                        </tr>
                               </tbody>
                           </table>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
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
  </body>
</html>

<form action="" method="">
    <table class="table table-bordered">
        <tr>
           
        </tr>
        <tr>

        </tr>
    </table>
</form>