
<!DOCTYPE html>
<html lang="en">
<?php require_once 'Template/header.php'; ?>
<body>
<?php 

include 'ratingcal.php';
$pid;

if(isset($_SESSION['pid']))
{
    $pid=$_SESSION['pid'];
}
 ?>


<style type="text/css">
    .checked {
  color: red;
}
</style>
<div class="container emp-profile" style="margin-top:20px">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                <?php
                    $q="select image from photographers where photographer_id=$pid";
                    $ans=mysqli_query($connection_name,$q);
                    while ($row=mysqli_fetch_assoc($ans)) {
                        
                        $image="images/".$row["image"];
                    ?>                                                        
                                        <div>  
                                        <img src="images/<?php echo $row['image']; ?>" alt="" style="width: 150px;height:150px;"> 
                                        </div> 
                                        <?php }?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <?php
                                            $q="select * from photographers where photographer_id=$pid";
                                            $ans=mysqli_query($connection_name,$q);
                                            while ($row=mysqli_fetch_assoc($ans)) {
                                        ?>                                                              
                                        <h5><?php echo $row['photographer_name'];?></h5> 
                                        <?php }?>
                                    </h5>
                                   
                                   <p class="proile-rating">
                                        Overall Rating : 
                                <?php 
                                $rvalue=rating($pid);
                      for($i=1;$i<=5;$i++)
                    {
                    if($i<=$rvalue)
                    {?>

                    <span class="fa fa-star checked"></span>
                    <?php
                         }
                         else
                        {
                echo '<span class="fa fa-star"></span>';
                        }}
                     ?>

                                    </p>
                    <hr class="bg-primary">
                           
                        </div>
                    </div>
                    <div class="col-md-2">
                    <a class="btn btn-lg bg-primary fas fa-edit" href="edit_profile.php" role="button" style='color: black;'>Edit</a>
                    <a class="btn btn-lg bg-primary fa fa-sign-out" href="index.php" class="nav-link logout" role="button" data-toggle="modal" data-target="#logoutModal" style='color: black;'>
                    <span class="d-none d-sm-inline-block" style="color: black">Logout</span></a>
                    </div>
                </div>

                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">Ready to Leave?</h6>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                        </div>
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.<br/>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel </button>
                        <a class="btn btn-primary" href="logout.php" role="button">Logout</a>
                        </div>

                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3" style="margin-top:20px">
                    <ul class="list-group">
                         <li class="list-group-item text-muted"> 
                         Section
                          <i class="fa fa-dashboard fa-1x"></i></li>
                          <li class="list-group-item"><span class="pull-left"><strong><a href="memberfee.php"> Check Member Fee</a></strong></span> </li>
                         <li class="list-group-item">
                            <span class="pull-left"><strong><a href="bookinglist.php"> Check Booking List</a></strong></span></li>
                         <li class="list-group-item"><span class="pull-left"><strong><a href="checkreview.php"> Check Reviews </a></strong></span> </li>
                         
                 </ul> 
                    </div>
                    <script>
                        function Setedate()
                        {
                            var pd=document.getElementById('pdate').value;
                            alert(pd);
    
                            var dd=new Date(pd);
                            var m=document.getElementById('m').value;
                            alert(m);
                            dd.setMonth(dd.getMonth() + m);
                            alert(dd);
                           
                           document.getElementById('edate').value=1111;
                            
                        }
                    </script>
                    <div class="col-md-9">
                        <div class="tab-content profile-tab" id="myTabContent">
                         
                         <div class="col-md-12">
            <h4>Add payment:</h4>
            <div class="panel panel-default">
                <div class="panel-body form-horizontal payment-form">
                     <div class="form-group">
                        <label for="date" class="col-sm-3 control-label"> Pay Date</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="pdate" name="pdate">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="amount" class="col-sm-3 control-label">Enter Month</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="m" name="m" onchange="Setedate();">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="amount" class="col-sm-3 control-label">Amount</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="amount" name="amount">
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label for="date" class="col-sm-3 control-label"> Expired Date</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="edate" name="edate">
                        </div>
                    </div>   
                    <div class="form-group">
                        <div class="col-sm-12 text-right">
                            <button type="submit" class="btn btn-info preview-add-button" name="add">
                             Add
                            </button>
                        </div>
                    </div>
                </div>
            </div>            
        </div> <!-- / panel preview -->
</form>
        <?php if(isset($_POST['add']))
        {
            $pdate=$_POST['pdate'];
            $amount=$_POST['amount'];
            $expdate=$_POST['edate'];
            $pid=$_SESSION['pid'];

            $insp=mysqli_query($connection_name,"INSERT INTO payments(photographer_id,paydate,expdate,amount,admin_id) VALUES($pid,'$pdate','$amount','$expdate',0)");
            if($insp)
            {
                echo "<script> location.href='memberfee.php'; </script>";
            }
            else
            {
                echo mysqli_error($connection_name);
            }
        } ?>

                        <div class="table">
                            <table class="table table-stripped">
                                <thead>
                                    <th> No </th>
                                    <th> Pay Date </th>
                                    <th> Experied Date </th>
                                    <th> Amount </th>
                                    <th> Confirm By Admin </th>
                                </thead>
                                <tbody>
    <?php 
    $no=1;
    $pid=$_SESSION['pid'];
    $aname;
    $se=mysqli_query($connection_name,"SELECT * FROM payments WHERE photographer_id=$pid ");
    while($r=mysqli_fetch_assoc($se))
    {
        $aid=$r['admin_id'];
    if($aid!=0)
    {
        $selp=mysqli_query($connection_name,"SELECT admin_name FROM admins WHERE admin_id=$aid");
        $aid=mysqli_fetch_assoc($selp);
        $aname=$aid['admin_name'];
    }
     ?>
                                    <tr>
                                        <td><?php echo $no; $no++;?></td>
                                        <td> <?php echo $r['paydate']; ?></td>
                                        <td> <?php echo $r['expdate']; ?></td>
                                        <td> <?php echo $r['amount']; ?></td>
                                        <td><?php if($aid==0) echo "Not confirm Yet";
                                        else echo $aname; ?></td>
                                    </tr>
    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        </div>
                </div>
                     
        </div>

<?php require_once 'Template/footer.php'; ?>
<!-- END footer -->

<!-- loader -->
<?php require_once 'Template/loader.php'; ?>

<?php require_once 'Template/script.php'; ?>
</body>
</html>