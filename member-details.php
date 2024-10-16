<?php
session_start();
$uid = "";
$uphone="";
$filter = '';
if (isset($_GET["uid"])) {
  $uid = $_GET["uid"];
  $uphone=substr($_GET["uid"],3);

}

$mongo = new MongoDB\Driver\Manager("mongodb+srv://nicheelee24:B0wrmtGcgtXKoXWN@cluster0.8yb8idj.mongodb.net/gms2024?retryWrites=true&w=majority&appName=Cluster0&serverSelectionTryOnce=false&serverSelectionTimeoutMS=30");

$filter = ['name' => $uid];
$options = [];
$query = new MongoDB\Driver\Query($filter, $options);
$rows = $mongo->executeQuery('gms2024.users', $query);
$agntsArr = $rows->toArray();

$filter = ['userPhone' => $uphone,'type'=>'deposit'];
$options = [];
$query = new MongoDB\Driver\Query($filter, $options);
$rows = $mongo->executeQuery('gms2024.transactions', $query);
$transDepositArr = $rows->toArray();

$filter = ['userPhone' => $uphone,'type'=>'withdraw'];
$options = [];
$query = new MongoDB\Driver\Query($filter, $options);
$rows = $mongo->executeQuery('gms2024.transactions', $query);
$transWithdrawArr = $rows->toArray();




include 'layout/header.php';
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <div class="col-sm-3"></div>
          <h1>Member Details</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Manage Members</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </div>

  <!-- Main content -->

  <div class="container-fluid">
    <div class="row">


      <div class="col-md-4">




      <form method="post" action="controllers/api.php?flag=createMem">
        <div class="card-body">
          <div class="form-group">
            <label style="font-size:18px;">Member Information</label><?php  ?>
          </div>
          <div class="form-group">
            <label style="font-size:16px;font-weight:normal">First Time Apply</label>
            <input type="text" name="firstdeposit" class="form-control" <?php if($uid!=""){ ?> value="<?php echo $_GET['_dt'];?>" readonly <?php } ?> placeholder="Phone Number">
          </div>
          <div class="form-group">
            <label style="font-size:16px;font-weight:normal">Phone Number</label>
            <input type="text" name="phone" class="form-control" <?php if($uid!=""){ ?> value="<?php echo $agntsArr[0]->phone; ?>" readonly <?php } ?> placeholder="Phone Number">
          </div>
          <div class="form-group">
            <label style="font-size:16px;font-weight:normal">Password</label>
            <input type="password" name="pwd" class="form-control" <?php if($uid!=""){ ?> value="<?php echo $agntsArr[0]->rpwd; ?>" readonly <?php } ?> placeholder="Password">
          </div>
          <div class="form-group">
            <label style="font-size:16px;font-weight:normal">Status</label>
            <select id="status" name="status" class="form-control" onchange="changeSts('<?php echo $uid;?>','<?php echo $agntsArr[0]->status;?>')">
              <option value="Active" <?php if($uid!=""){ if($agntsArr[0]->status=='Active') {?> selected<?php }} ?>>Active</option>
              <option value="Blacklist" <?php if($uid!=""){ if($agntsArr[0]->status=='Blacklist') {?> selected<?php }} ?>>Blacklist</option>
              <option value="Block" <?php if($uid!=""){ if($agntsArr[0]->status=='Block') {?> selected<?php }} ?>>Block</option>
            </select>
            
          </div>




          <div class="form-group">
            <label style="font-size:18px;">Bank Information</label>
          </div>
          <div class="form-group">
            <label style="font-size:16px;font-weight:normal">Bank Name</label>
            <input type="text"  name="bbn" class="form-control" <?php if($uid!=""){ ?> value="<?php echo $agntsArr[0]->bbn; ?>"<?php }?> placeholder="Bank Name">
          </div>
          <div class="form-group">
            <label style="font-size:16px;font-weight:normal">Account Number</label>
            <input type="text" name="ban" class="form-control" <?php if($uid!=""){ ?> value="<?php echo $agntsArr[0]->bban; ?>"<?php }?> placeholder="Currency">
          </div>

          <div class="form-group">
            <label style="font-size:16px;font-weight:normal">Bank User Name</label>
            <input type="text" name="bun" class="form-control" <?php if($uid!=""){ ?> value="<?php echo $agntsArr[0]->bbun; ?>"<?php }?> placeholder="Currency">
          </div>
          <div class="form-group">
          <button  title="Save details" type="submit" class="btn btn-info">Submit</button>

          </div>
          </form>
          <div class="form-group" <?php if($uid==""){ ?>style="display:none" <?php } ?>>
            <label style="font-size:18px;">Deposit History</label>
          </div>
          <div class="form-group" <?php if($uid==""){ ?>style="display:none" <?php } ?>>
            <div class="card-body p-0">
              <table class="table">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Bank Name</th>
                    <th>Status</th>


                  </tr>
                </thead>
                <tbody>
                  <?php $cnt=1;
                  foreach($transDepositArr as $deposit){
                  ?>
                  <tr>
                    <td><?php echo $cnt; ?></td>
                    <td><?php echo $deposit->date->toDateTime()->format('Y-m-d H:i:s')?></td>
                    <td><?php echo  $deposit->payAmount?></td>
                    <td><?php echo   $agntsArr[0]->bbn;?></td>
                    <td></td>
                  </tr>
                  <?php $cnt++; }?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="form-group" <?php if($uid==""){ ?>style="display:none" <?php } ?>>
            <label style="font-size:18px;">Enter Amount To Deposit</label>
            <input type="Text" class="form-control" id="withDeposit"/>
            </div>
            <div class="form-group" <?php if($uid==""){ ?>style="display:none" <?php } ?>>
            <button  title="Manual Deposit" type="button" class="btn btn-info">Deposit</button>
            </div>

            <div class="form-group" <?php if($uid==""){ ?>style="display:none" <?php } ?>>
              <label style="font-size:18px;">Withdraw History</label>
            </div>
            <div class="form-group" <?php if($uid==""){ ?>style="display:none" <?php } ?>>
            <div class="card-body p-0">
              <table class="table">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Bank Name</th>
                    <th>Status</th>



                  </tr>
                </thead>
                <tbody>
                <?php $cnt=1;
                  foreach($transWithdrawArr as $withdraw){
                  ?>
                  <tr>
                    <td><?php echo $cnt; ?></td>
                    <td><?php echo $withdraw->date->toDateTime()->format('Y-m-d H:i:s')?></td>
                    <td><?php echo  $withdraw->payAmount?></td>
                    <td><?php echo   $agntsArr[0]->bbn;?></td>
                    <td></td>
                  </tr>
                  <?php $cnt++; }?>
                </tbody>
              </table>
            </div>
            </div>
            <div class="form-group" <?php if($uid==""){ ?>style="display:none" <?php } ?>>
            <label style="font-size:18px;">Enter Amount To Withdraw</label>
            <input type="Text" class="form-control" id="withAmt"/>
            </div>
            <div class="form-group" <?php if($uid==""){ ?>style="display:none" <?php } ?>>
            <button  title="Manual Withdraw" type="button" class="btn btn-info">Withdraw</button>
            </div>




            <!-- /.card-body -->




          </div>
        </div>
        <!-- /.col -->

        <!-- /.col -->
      </div>


      <!-- /.row -->
    </div><!-- /.container-fluid -->

    <!-- /.content -->
  </div>

  <?php
  include 'layout/footer.php';
  ?>
  <script>

function changeSts(un,sts)
{
//alert(un+"-"+sts);
if(sts=='Block')
{

  if(confirm("Are you sure to BLOCK this player?"))
{
$.ajax({
          url:"controllers/api.php?flag=actDeact",    
          type: "get",    //request type,
          data: {uname: un, stats: sts},
          success:function(){
            alert("Member is blocked.");
            location.reload();
          }
      });
  
}
}
if(sts=='Active')
{
if(confirm("Are you sure to ACTIVATE this player?"))
{
  
      $.ajax({
          url:"controllers/api.php?flag=actDeact",    
          type: "get",    //request type,
          data: {uname: un, stats: sts},
          success:function(){
            alert("Member is activated.");
            location.reload();
          }
      });
  

}
}
if(sts=='Blacklist')
{
if(confirm("Are you sure to BLACKLIST this player?"))
{
  
      $.ajax({
          url:"controllers/api.php?flag=actDeact",    
          type: "get",    //request type,
          data: {uname: un, stats: sts},
          success:function(){
            alert("Member is blacklisted.");
            location.reload();
          }
      });
  

}

}
}
//Date range picker
$('#reservation').daterangepicker();
$(document).ready(function () {
  //setInterval(function() {
     // $.get("manage-members.php", function (result) {
      //  alert(result);
        //  $('#dvcontent').html(result);
    //  });
 // }, 3000);
});
</script>