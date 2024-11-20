<?php
session_start();
require_once "vendor/autoload.php";
include 'layout/header.php';

$uid = "";
if (isset($_GET["eid"])) {
    $uid = $_GET["eid"];
}
$filter=[];
$options=[];
$mongo = new MongoDB\Driver\Manager("mongodb+srv://nicheelee24:B0wrmtGcgtXKoXWN@cluster0.8yb8idj.mongodb.net/gms2024?retryWrites=true&w=majority&serverSelectionTryOnce=false&serverSelectionTimeoutMS=30&appName=Cluster0");
if($uid!="")
{
$filter = ["_id" => new MongoDB\BSON\ObjectID($uid)];
$options = [];
}
$query = new MongoDB\Driver\Query($filter, $options);
$rows = $mongo->executeQuery('gms2024.promotions', $query);
$agntsArr = $rows->toArray();
//print_r($agntsArr);
$cnt = count($agntsArr);
//die($cnt);
//$cnt = count($agntsArr);
//echo $cnt;
//echo "hi";
// use Google\Authenticator\GoogleAuthenticator;
// use Google\Authenticator\GoogleQrUrl;

// $googleAuthenticator = new GoogleAuthenticator();
// $secret = $googleAuthenticator->generateSecret();
// $qrCodeUrl = GoogleQrUrl::generate('employeename', $secret, 'Backoffice');
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="col-sm-3"></div>
                    <h1>Create/Update Promotion</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Promote</li><?php echo $uid; ?>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">


                <form method="post" enctype="multipart/form-data" <?php if ($uid == ""){?> action="controllers/api.php?flag=createPromotion" <?php }else{ ?> action="controllers/api.php?flag=updPromotion&id=<?php echo $uid;?>" <?php } ?>>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Bonus Pic</label>
                                    <input type="file" name="file">
                                   <img src="/ama-bundai/uploads/<?php if ($uid != ""){ echo $agntsArr[0]->photo; 
                                                }?>" width="150px" height="80px" />
                                </div>

                                <div class="form-group">
                                    <label>Promotion Title</label>
                                    <input type="text" name="title" class="form-control" required
                                        value="<?php if ($uid != ""){ echo $agntsArr[0]->title; 
                                                }?>" placeholder="Promotion Name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea  name="details" class="form-control" required
                                        value="<?php if ($uid != ""){ echo $agntsArr[0]->details; 
                                                }?>"><?php if ($uid != ""){ echo $agntsArr[0]->details; 
                                                }?></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Promotion Code</label>
                                    <input type="text" name="promoCode" class="form-control"
                                        value="<?php if ($uid != ""){ echo $agntsArr[0]->promoCode; 
                                                }?>" required
                                        placeholder="Promo Code">
                                </div>
                                <div class="form-group">
                                    <label>Expiry Date</label>
                                    <input type="text" name="expdt" class="form-control" required
                                        value="<?php if ($uid != ""){ echo $agntsArr[0]->expDate; 
                                                }?>" placeholder="Expiry Date">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label>Bonus Type</label>
                                    <select class="custom-select" name="bonusType" id="bonusType">
                                        <?php 
                                        if ($agntsArr[0]->bonusType == "newmember") {

                                        ?>
                                                <option value="newmember" selected>New Member</option>
                                            <?php
                                        }
                                     else {
                                            ?>
                                            <option value="newmember">New Member</option>
                                        <?php }

                                        ?>
                                        <?php 
                                            if ($agntsArr[0]->bonusType == "firstdeposit") {

                                        ?>
                                                <option value="firstdeposit" selected>First Deposit</option>
                                            <?php
                                            }
                                         else {
                                            ?>
                                            <option value="firstdeposit">First Deposit</option>
                                        <?php }

                                        ?>
                                        <?php 
                                            if ($agntsArr[0]->bonusType == "goldenminute") {

                                        ?>
                                                <option value="goldenminute" selected>Golden Minute</option>
                                            <?php
                                            }
                                         else {
                                            ?>
                                            <option value="goldenminute">Golden Minute</option>
                                        <?php }

                                        ?>
                                         <?php 
                                            if ($agntsArr[0]->bonusType == "fullpromotion") {

                                        ?>
                                                <option value="fullpromotion" selected>Full Promotion</option>
                                            <?php
                                            }
                                         else {
                                            ?>
                                            <option value="fullpromotion">Full Promotion</option>
                                        <?php }

                                        ?>
                                         <?php 
                                            if ($agntsArr[0]->bonusType == "refundofloss") {

                                        ?>
                                                <option value="refundofloss" selected>Refund Of Losses</option>
                                            <?php
                                            }
                                         else {
                                            ?>
                                            <option value="refundofloss">Refund Of Losses</option>
                                        <?php }

                                        ?>
                                         <?php 
                                            if ($agntsArr[0]->bonusType == "wheel") {

                                        ?>
                                                <option value="wheel" selected>Wheel</option>
                                            <?php
                                            }
                                         else {
                                            ?>
                                            <option value="wheel">Wheel</option>
                                        <?php }

                                        ?>
                                       

                                    </select>
                                </div>
                            </div>
                        </div>
                        
                       
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Deposit</label>
                                    <input type="text" name="depositAmnt" class="form-control" required
                                        value="<?php if ($uid != ""){ echo $agntsArr[0]->depositAmnt; 
                                                }?>" placeholder="0.00">
                                </div>

                               
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label>Bonus</label>
                                    <select class="custom-select" onchange="changeCategory(this)" name="bonusCategory" id="bonusCategory">
                                        <?php 
                                        if ($agntsArr[0]->bonusCategory == "amntTHB") {

                                        ?>
                                                <option value="amntTHB"  selected>Amount In THB</option>
                                            <?php
                                        }
                                     else {
                                            ?>
                                            <option style="font-weight:bold" value="amntTHB">Amount In THB</option>
                                        <?php }

                                        ?>
                                        <?php 
                                            if ($agntsArr[0]->bonusCategory == "percent") {

                                        ?>
                                                <option value="percent" selected>Percent</option>
                                            <?php
                                            }
                                         else {
                                            ?>
                                            <option style="font-weight:bold" value="percent">Percent</option>
                                        <?php }

                                        ?>
                                       
                                    </select>
                                    <input type="text" name="bonusAmnt" id="bonusAmnt" class="form-control" required
                                        value="<?php if ($uid != ""){ echo $agntsArr[0]->bonusAmnt; 
                                                }?>" placeholder="Enter amount in THB">

                                                <input type="text" name="percentBonus" id="percentBonus" class="form-control" style="display:none" required
                                        value="<?php if ($uid != ""){ echo $agntsArr[0]->percentBonus; 
                                                }?>" placeholder="Enter value in %">

                                                <input type="text" name="highestPercent" id="highestPercent" class="form-control" style="display:none" required
                                        value="<?php if ($uid != ""){ echo $agntsArr[0]->highestPercent; 
                                                }?>" placeholder="Maximum % value">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Turnover</label>
                                    <input type="text" name="turnover" class="form-control" required
                                        value="<?php if ($uid != ""){ echo $agntsArr[0]->turnover; 
                                                }?>" placeholder="0">
                                </div>

                               
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label>Is Active</label>
                                    <select class="custom-select" name="status" id="status">
                                        <?php 
                                        if ($agntsArr[0]->status == "yes") {

                                        ?>
                                                <option value="yes" selected>Yes</option>
                                            <?php
                                        }
                                     else {
                                            ?>
                                            <option value="yes">Yes</option>
                                        <?php }

                                        ?>
                                        <?php 
                                            if ($agntsArr[0]->status == "no") {

                                        ?>
                                                <option value="no" selected>No</option>
                                            <?php
                                            }
                                         else {
                                            ?>
                                            <option value="no">No</option>
                                        <?php }

                                        ?>
                                       
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label>Conditions</label>
                                    <div class="form-check">
                                        <input class="form-check-input all" onclick="checkAll()" type="checkbox" name="permissions[]" <?php if ($uid != "") if (in_array("All", $agntsArr[0]->permissions)) { ?> checked <?php } ?>
                                            value="All">
                                        <label class="form-check-label">All Conditions</label>
                                    </div>

                                   
                                    <div class="form-check">
                                        <input class="form-check-input" onclick="checkUncheck(this)" type="checkbox" name="permissions[]" <?php if ($uid != "") if (in_array("newcust", $agntsArr[0]->permissions)) { ?> checked <?php } ?>
                                            value="newcust">
                                        <label class="form-check-label">For New Customers</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" onclick="checkUncheck(this)" name="permissions[]" type="checkbox" <?php if ($uid != "") if (in_array("oldcust", $agntsArr[0]->permissions)) { ?> checked <?php } ?>
                                            value="oldcust">
                                        <label class="form-check-label">For Old Customers</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" onclick="checkUncheck(this)" name="permissions[]" type="checkbox" <?php if ($uid != "") if (in_array("topupBonus", $agntsArr[0]->permissions)) { ?> checked <?php } ?>
                                            value="topupBonus">
                                        <label class="form-check-label">Top up free bonus creation</label>
                                    </div>
                                    
                                    <div class="form-check">
                                        <input class="form-check-input" onclick="checkUncheck(this)" type="checkbox" name="permissions[]" value="forFirstDeposit" <?php if ($uid != "") if (in_array("forFirstDeposit", $agntsArr[0]->permissions)) { ?> checked <?php } ?>>
                                        <label class="form-check-label">For first deposit every day</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" onclick="checkUncheck(this)" type="checkbox" name="permissions[]" value="autoBonus" <?php if ($uid != "") if (in_array("autoBonus", $agntsArr[0]->permissions)) { ?> checked <?php } ?>>
                                        <label class="form-check-label">Automatic bonus top up</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" onclick="checkUncheck(this)" name="permissions[]" type="checkbox" <?php if ($uid != "") if (in_array("deleteProm", $agntsArr[0]->permissions)) { ?> checked <?php } ?>
                                            value="deleteProm">
                                        <label class="form-check-label">Delete promotion status after withdraw</label>
                                    </div>





                                   
                                    <div class="form-check">
                                        <input class="form-check-input" onclick="checkUncheck(this)" type="checkbox" name="permissions[]" value="hideProm" <?php if ($uid != "") if (in_array("hideProm", $agntsArr[0]->permissions)) { ?> checked <?php } ?>>
                                        <label class="form-check-label">Hide promotion button</label>
                                    </div>

                                   
                                   
                                </div>
                            </div>

                        </div>













                        <!-- /.card-body -->

                        <div class="card-footer">
                            <?php if($uid!=""){ ?>
                            <button type="submit" class="btn btn-primary" <?php if(isset($_SESSION["access"])){ ?> style="display:block" <?php } ?> >Update</button>
                            <?php } else{?>
                           
                            <button type="submit" <?php if(isset($_SESSION["access"])){ if(!in_array('createEmp',$_SESSION["access"])){ ?> style="display:block" <?php }} ?> class="btn btn-primary" >Submit</button>
                            <?php } ?>
                        </div>
                </form>
            </div>
        </div>
        <!-- /.col -->

        <!-- /.col -->
    </div>


    <!-- /.row -->
</div><!-- /.container-fluid -->

<!-- /.content -->
</div>
<script>
    function checkAll() {
        var ele = document.getElementsByName('permissions[]');
        //alert(ele);  
        for (var i = 0; i < ele.length; i++) {
            if (ele[i].checked == false)
                ele[i].checked = true;


        }
    }

    function checkUncheck(ele) {
        // alert(ele.checked);
        if (ele.checked == false) {
            var elem = document.querySelector('.all');
            // alert(elem.value);
            elem.checked = false;

        }

    }

    function changeCategory(vl)
    {
       // alert(vl.value);
        if(vl.value=='percent')
    {
        document.getElementById("bonusAmnt").style.display='none'; 
        document.getElementById("percentBonus").style.display='block'; 
        document.getElementById("highestPercent").style.display='block'; 
    }
    else
    {
        document.getElementById("bonusAmnt").style.display='block'; 
        document.getElementById("percentBonus").style.display='none'; 
        document.getElementById("highestPercent").style.display='none'; 
    }

    }
</script>

<?php
include 'layout/footer.php';
?>