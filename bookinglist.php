
<!DOCTYPE html>
<html lang="en">
<?php require_once 'Template/header.php'; ?>
<body>
<?php 

$pid;
include 'ratingcal.php';

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
                   
                    <div class="col-md-9">
                        <div class="tab-content profile-tab" id="myTabContent">
                      <h4 class="text-primary">   Check My Booking List </h4> 
                           
                        </div> <!-- / panel preview -->

                        <div class="table">
                            <table class="table table-stripped">
                                <thead style="font-size: 13px;">
                                    <th> No </th>
                                    <th> Customer </th>
                                    <th> Contact No  </th>
                                    <th> Phot Type</th>
                                    <th> Place </th>
                                    <th> Booking Date </th>
                                    <th> Shoot Date </th>
                                    <th> Shoot Time </th>
                                    <th> Description </th>
                                    <th> Action </th>
                                </thead>
                                <tbody>
    <?php 
    $no=1;
    $pid=$_SESSION['pid'];
    $aname;
   $sel=mysqli_query($connection_name,"SELECT bk.*,t.type_name,p.place_name,ph.photographer_name,c.customer_name,c.phone
FROM bookings bk,places p,photoplaces pp,types t,phototypes pt,photographers ph,customers c
WHERE bk.ppid=pp.ppid AND pp.place_id=p.place_id AND bk.phototype_id=pt.phototype_id AND pt.type_id=t.type_id AND pt.photographer_id=ph.photographer_id AND pp.photographer_id=ph.photographer_id AND c.customer_id=bk.customer_id AND ph.photographer_id=$pid order by bk.booking_id DESC");
  while($r=mysqli_fetch_assoc($sel))
  { 
    $bid=$r['booking_id'];
    $bdate=$r['bookingdate'];
    $sdate=$r['shoot_date'];
    $stime=$r['stime'];
    $shottime=$r['shoot_time'];
    $name=$r['customer_name'];
    $ph=$r['phone'];
    $bstate=$r['bstate'];
    $place=$r['place_name'];
    $type=$r['type_name'];
  ?>
   

               <tr>
                  <td><?php echo $no;$no++; ?></td>
                  <td><?php echo $name; ?></td>
                  <td><?php echo $ph; ?></td>
                  <td> <?php echo $type; ?></td>
                  <td> <?php echo $place; ?></td>
                  <td><?php echo $bdate; ?></td>
                  <td> <?php echo $sdate; ?></td>
                  <td> <?php echo $stime." - ".$shottime; ?></td>
                  <td> <?php echo $r['description']; ?></td>
                  
                  <td> <?php
                  if($bstate==1)
                  {
                    echo "<a href='?bid=$bid' class='btn btn-danger btn-sm'> Cancel </a> <br>";
                    echo "<a href='?btid=$bid' class='btn btn-info btn-sm'> Shoot </a>";
                  } 
                  elseif($bstate==0)
                  {
                    echo "Canceled";
                  }
                  elseif($bstate==2)
                  {
                    echo "Shooted";
                  }
                   ?>
                      
                    </td>
                                    </tr>
    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        </div>
                </div>
            </form>           
        </div>

<?php require_once 'Template/footer.php'; ?>
<!-- END footer -->

<!-- loader -->
<?php require_once 'Template/loader.php'; ?>

<?php require_once 'Template/script.php'; ?>
</body>
</html>

<?php 
if(isset($_GET['bid']))
{
  $bid=$_GET['bid'];
  
  $upd=mysqli_query($connection_name,"UPDATE bookings SET bstate=0 WHERE booking_id=$bid");
  if($upd)
  {
    echo "<script>  location.href='bookinglist.php'; </script>";
  }

}

if(isset($_GET['btid']))
{
  $bid=$_GET['btid'];
  
  $upd=mysqli_query($connection_name,"UPDATE bookings SET bstate=2 WHERE booking_id=$bid");
  if($upd)
  {
    echo "<script>  location.href='bookinglist.php'; </script>";
  }

}

 ?>