
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
                                        <img src="images/<?php echo $row['image']; ?>" alt="" style="width: 200px;height: 200px;"> 
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

                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="location-tab" data-toggle="tab" href="#location" role="tab" aria-controls="location" aria-selected="true"> Photo Type </a>
                                </li>

                                 <li class="nav-item">
                                    <a class="nav-link" id="place-tab" data-toggle="tab" href="#place" role="tab" aria-controls="place" aria-selected="true">  Places </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">MyPhoto</a>
                                </li>
                            </ul>
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

                                       
                            </div>

                            <!-- location-tab -->
                            <div class="tab-pane fade" id="location" role="tabpanel" aria-labelledby="location-tab">

                            <div class="panel col-md-12">
                                <form action="" method="post">
                                  <div class="row"> 
                                  <div class="col-md-6">  <label> Select Photo Type </label>
                                    <select name="tid" class="form-control">
                                        <option> Photo Type </option>
                                        <?php 
                                        $sl=mysqli_query($connection_name,"SELECT * FROM types");
                                        while($rl=mysqli_fetch_assoc($sl))
                                        { ?>
                                <option value="<?php echo $rl['type_id']; ?>"> <?php echo $rl['type_name']; ?></option>
                                       <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mt-5">

                            <input type="submit" name="addtype" value="Add" class="btn btn-outline-info btn-primary">
                                    </div>
                                </div>
                                </form>
                            </div>

<?php 
    if(isset($_POST['addtype']))
    {
      $pid=$_SESSION['pid'];
      $tid=$_POST['tid'];
      $ifs=mysqli_query($connection_name,"SELECT * FROM phototypes WHERE photographer_id=$pid AND type_id=$tid");
      if($linet=mysqli_fetch_assoc($ifs))
      {
        echo "<script> alert('Already added type'); </script>";
      }
      else
      {
      $in=mysqli_query($connection_name,"INSERT INTO phototypes(photographer_id,type_id) VALUES($pid,$tid)");
      if($in)
      {

      } 
      } 
    }


    if(isset($_GET['ptid']))
    {
        $ptid=$_GET['ptid'];
        $del=mysqli_query($connection_name,"DELETE FROM phototypes WHERE phototype_id=$ptid");
        if($del)
        {
            echo "<script> location.href='profile.php';</script>";
        }

    }
 ?>
                            <div class="table mt-5">
                                <table class="table table-bordered">
                                    <thead>
                                        <th> No </th>
                                        <th> Photo Type </th>
                                        <th> Remove</th>
                                    </thead>

                                    <tbody>
            <?php 
            $pid=$_SESSION['pid'];
            $pn=1;
            $selp=mysqli_query($connection_name,"SELECT * FROM photographers ph,phototypes pt,types t WHERE t.type_id=pt.type_id AND pt.photographer_id=ph.photographer_id AND ph.photographer_id=$pid");
            while($rpl=mysqli_fetch_assoc($selp))
            { ?>
                            <tr>
                                <td> <?php echo $pn;$pn++; ?></td>
                                <td> <?php echo $rpl['type_name']; ?> </td>
                                <td> <a href="?ptid=<?php echo $rpl['phototype_id']; ?>"> Remove</a></td>
                            </tr>
             <?php } ?>                       
                                    </tbody>
                                </table>
                            </div>

                            </div>
    <div class="tab-pane fade" id="place" role="tabpanel" aria-labelledby="place-tab">

                            <div class="panel col-md-12">
                                <form action="" method="post">
                                  <div class="row"> 
                                  <div class="col-md-6">  <label> Select Place </label>
                                    <select name="pid" class="form-control">
                                        <option> Places </option>
                                        <?php 
                                        $sl=mysqli_query($connection_name,"SELECT * FROM places");
                                        while($rl=mysqli_fetch_assoc($sl))
                                        { ?>
                                <option value="<?php echo $rl['place_id']; ?>"> <?php echo $rl['place_name']; ?></option>
                                       <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mt-5">

                            <input type="submit" name="addplace" value="Add" class="btn btn-outline-info btn-primary">
                                    </div>
                                </div>
                                </form>
                            </div>

<?php 
    if(isset($_POST['addplace']))
    {
      $pid=$_SESSION['pid'];
      $plid=$_POST['pid'];

      $ifs=mysqli_query($connection_name,"SELECT * FROM photoplaces WHERE photographer_id=$pid AND place_id=$plid");
      if($linet=mysqli_fetch_assoc($ifs))
      {
        echo "<script> alert('Already added type'); </script>";
      }
      else
      {
      $in=mysqli_query($connection_name,"INSERT INTO photoplaces(photographer_id,place_id) VALUES($pid,$plid)");
      if($in)
      {

      } 
      } 
    }


    if(isset($_GET['ppid']))
    {
        $ppid=$_GET['ppid'];
        $del=mysqli_query($connection_name,"DELETE FROM photoplaces WHERE ppid=$ppid");
        if($del)
        {
            echo "<script> location.href='profile.php';</script>";
        }

    }
 ?>
                            <div class="table mt-5">
                                <table class="table table-bordered">
                                    <thead>
                                        <th> No </th>
                                        <th> Place </th>
                                        <th> Remove</th>
                                    </thead>

                                    <tbody>
            <?php 
            $pid=$_SESSION['pid'];
            $pn=1;
            $selp=mysqli_query($connection_name,"SELECT * FROM photographers ph,photoplaces pt,places t WHERE t.place_id=pt.place_id AND pt.photographer_id=ph.photographer_id AND ph.photographer_id=$pid");
            while($rpl=mysqli_fetch_assoc($selp))
            { ?>
                            <tr>
                                <td> <?php echo $pn;$pn++; ?></td>
                                <td> <?php echo $rpl['place_name']; ?> </td>
                                <td> <a href="?ppid=<?php echo $rpl['ppid']; ?>"> Remove</a></td>
                            </tr>
             <?php } ?>                       
                                    </tbody>
                                </table>
                            </div>

                            </div>





                            <!-- phototab -->
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                                <div class="panel col-md-12">
                                <form action="" method="post" enctype="multipart/form-data">
                                  <div class="row"> 
                                <div class="col-md-6">  <label>  Your Photo Type </label>
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

                                <div class="col-md-6 mt-5">  <label>  Photo </label>
                                    <input type="file" name="photo" class="text-center center-block file-upload">
                                </div>

                                <div class="mt-5">

                            <input type="submit" name="add" value="Add" class="btn btn-outline-info btn-primary">
                                    </div>
                                </div>
                                </form>
                            </div>

            <?php 
            if(isset($_POST['add']))
            {
                $photo=$_FILES['photo']['name'];
                $tmp=$_FILES['photo']['tmp_name'];
                $ptid=$_POST['ptid'];

                $insp=mysqli_query($connection_name,"INSERT INTO photos(photo_name,phototype_id) VALUES('$photo','$ptid')");
                if($insp)
                {
                    move_uploaded_file($tmp,"SiteImages/Photo/".$photo);
                }

            } ?>



                                    <div class="row">
                                    <?php
                                    $pid=$_SESSION['pid'];
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
                                        <a href="">
                                            <img  src="<?php echo $image; ?>" class="zoom img-fluid "  alt="">
                                        </a>
                                    
                                    </div> 
                            <?php }
                        }?>
                                   
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