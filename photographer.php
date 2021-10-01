
<!DOCTYPE html>
<html lang="en">
<?php require_once 'Template/header.php'; ?>
<body>
<?php require_once 'Template/nav.php'; ?>
<?php 

$pid;

if(isset($_GET['phid']))
{
    $pid=$_GET['phid'];
}

 ?>

<div class="container emp-profile" style="margin-top:130px">
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
                                        <img src="images/<?php echo $row['image']; ?>" alt="" style="width: 200px;height: 200px;"> 
                                        </div> 
                                        <?php }?>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="profile-head">
                                    <?php
                                            $q="SELECT * FROM photographers where photographer_id=$pid";
                                            $ans=mysqli_query($connection_name,$q);
                                            while ($row=mysqli_fetch_assoc($ans)) {
                                        ?>                                                              
                                        <h5><?php echo $row['photographer_name'];?></h5> 
                                        <?php }?>
                                    </h5>
                                    <p class="proile-rating">RANKINGS : <span>8/10</span></p>

                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                              
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Photos</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="booking-tab" data-toggle="tab" href="#booking" role="tab" aria-controls="booking" aria-selected="false">Booking </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                   
                </div>
                
                <div class="row">
                <div class="col-md-3">
                </div>                    
                <div class="col-md-9">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-md-8">
                                            <?php
                                            $q="select * from photographers where photographer_id=$pid";
                                            $ans=mysqli_query($connection_name,$q);
                                            $row=mysqli_fetch_assoc($ans);
                                            ?>                                                              
                                            <p value="<?php echo $row['photographer_id'];?>">
                                            <?php echo $row['photographer_name'];?>
                                            </p> 
                                           
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-8">
                                            <?php
                                            $q="SELECT * FROM photographers WHERE photographer_id=$pid";
                                            $ans=mysqli_query($connection_name,$q);
                                            $row=mysqli_fetch_assoc($ans);
                                            ?>                                                              
                                            <p>
                                            <?php echo $row['email'];?>
                                            </p> 
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Phone</label>
                                            </div>
                                            <div class="col-md-8">
                                                                                                         
                                            <p>
                                            <?php echo $row['phone'];?>
                                            </p> 
                                    
                                            </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-4">
                                                <label>Description</label>
                                            </div>
                                            <div class="col-md-8">
                                                                                                   
                                            <p>
                                            <?php echo $row['description'];?>
                                            </p> 
                                           
                                            </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-4">
                                                <label>Experience</label>
                                            </div>
                                            <div class="col-md-8">
                                                                                                       
                                            <p value="<?php echo $row['photographer_id'];?>">
                                            <?php echo $row['experience'];?>
                                            </p> 
                                           
                                            </div>
                                        </div>

                                        <div class="row">
                                        <div class="col-md-4">
                                                <label> Shoot Types </label>
                                            </div>
                                            <div class="col-md-8">
                        <?php 
                        $sl=mysqli_query($connection_name,"SELECT type_name FROM types,phototypes WHERE phototypes.type_id=types.type_id AND phototypes.photographer_id=$pid");
                        while($tt=mysqli_fetch_assoc($sl))
                        {
                         ?>                                                         
                                            <p class="text-info">
                                            <?php echo $tt['type_name'];?>
                                            </p> 
                           <?php } ?>                
                                            </div>
                                        </div>

                                        <div class="row">
                                        <div class="col-md-4">
                                                <label>Location</label>
                                            </div>
                                            <div class="col-md-8">
                                            <?php
                                            $q="SELECT * FROM places pl,photographers p,photoplaces pp WHERE pl.place_id=pp.place_id AND p.photographer_id=pp.photographer_id AND p.photographer_id=$pid";
                                            $ans=mysqli_query($connection_name,$q);
                                            while ($row=mysqli_fetch_assoc($ans)) 
                                            {
                                            ?>                                                              
                                            <p class="text-success">
                                            <?php echo $row['place_name'];?>
                                            </p> 
                                            <?php }?>
                                            </div>
                                        </div>
                            </div>

                            <!-- location-tab -->
                        

                            <!-- phototab -->
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                                    <div class="row">
                                    <?php
                                   
                                            $q="SELECT photo_name,phototypes.phototype_id from photos,phototypes where photos.phototype_id=phototypes.phototype_id AND phototypes.photographer_id=$pid";
                                            $ans=mysqli_query($connection_name,$q);
                                            $rn=mysqli_fetch_assoc($ans);
                                            if($rn>0)
                                            {
                                            while ($row=mysqli_fetch_assoc($ans)) 
                                            {
                                                
                                                $image="SiteImages/Photo/".$row["photo_name"];
                                    ?>                                                        
                                    <div class="col-lg-3 col-md-4 col-xs-6 thumb mt-5">
                                        <a href="<?php echo $image; ?>">
                                            <img  src="<?php echo $image; ?>" class="zoom img-fluid "  alt="">
                                        </a>
                                    
                                    </div> 
                            <?php }
                        }?>
                                   
                                 </div>
                                 </div>
                    <div class="tab-pane fade" id="booking" role="tabpanel" aria-labelledby="booking-tab">

<?php if(isset($_SESSION['customer']))
{ ?>
            <div class="col-md-12">
            <h5> Fill Booking Form :</h5>
            <div class="panel panel-default">
                <div class="panel-body form-horizontal payment-form">
                     <div class="form-group">
                        <label for="date" class="col-sm-3 control-label"> Photo Type </label>
                        <div class="col-sm-9">
                 <select name="ptid" class="form-control">
                            <option> Photo Type </option>
                            <?php 
                            $sl=mysqli_query($connection_name,"SELECT phototype_id,type_name FROM photographers ph,phototypes pt,types t WHERE t.type_id=pt.type_id AND pt.photographer_id=ph.photographer_id AND ph.photographer_id=$pid");
                            while($rl=mysqli_fetch_assoc($sl))
                            { ?>
                    <option value="<?php echo $rl['phototype_id']; ?>"> <?php echo $rl['type_name']; ?></option>
                           <?php } ?>
                    </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="date" class="col-sm-3 control-label"> Places </label>
                        <div class="col-sm-9">
                 <select name="ppid" class="form-control">
                            <option> Places </option>
                            <?php 
                            $sl=mysqli_query($connection_name,"SELECT ppid,place_name FROM photographers ph,photoplaces pt,places t WHERE t.place_id=pt.place_id AND pt.photographer_id=ph.photographer_id AND ph.photographer_id=$pid");
                            while($rl=mysqli_fetch_assoc($sl))
                            { ?>
                    <option value="<?php echo $rl['ppid']; ?>"> <?php echo $rl['place_name']; ?></option>
                           <?php } ?>
                    </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="date" class="col-sm-3 control-label"> Shoot Date </label>
                        <div class="col-sm-9">
                        <input type="date" name="sdate" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="amount" class="col-sm-3 control-label"> Shoot Time </label>
                        <div class="col-sm-9">
                            <select name="stime" class="form-control">
                                <option> ----- </option>
                                <option value="Morning"> Morning </option>
                                <option value="Evening"> Evening </option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="amount" class="col-sm-3 control-label"> Time </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="time" name="time" placeholder="10:00 AM">
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label for="date" class="col-sm-3 control-label"> Special Request </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="des" name="des">
                        </div>
                    </div>   
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-info" name="book">
                             Book
                            </button>
                        </div>
                    </div>
                </div>
            </div>            
        </div>

    <?php }
    else
    {?>

<label class="text-danger text-center"> Need to login for Booking </label> <br>
<a href="custlogin.php" class="btn btn-outline-danger"> Login </a>
  <?php  } ?>

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

if(isset($_POST['book']))
{
    $ptid=$_POST['ptid'];
    $ppid=$_POST['ppid'];
    $sdate=$_POST['sdate'];
    $stime=$_POST['stime'];
    $time = $_POST['time'];
    $des=$_POST['des'];

    $bdate=date('Y-m-d');
    $cid=$_SESSION['customer'];

    $inbo=mysqli_query($connection_name,"INSERT INTO bookings(phototype_id,customer_id,bookingdate,shoot_date,stime,shoot_time,ppid,description,bstate) VALUES($ptid,$cid,'$bdate','$sdate','$time','$stime',$ppid,'$des',1)");
    if($inbo)
    {
        echo "<script> alert('Booking Complete! You can also cancel in 2 days before your shoot_date');
        location.href='bookinginfo.php'; </script>";
    }

}

 ?>
