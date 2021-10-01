<?php include 'database.php' ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once 'Template/header.php'; ?>
<body>

    <script>
  var loadFile = function(event) {
  var image = document.getElementById('output');
  image.src = URL.createObjectURL(event.target.files[0]);};
    </script>


<style type="text/css">
    .checked {
  color: red;
}
</style>
<div class="container emp-profile">
 <?php
 include 'ratingcal.php';

        $pid=$_SESSION['pid'];
        $q="select * from photographers WHERE photographer_id=$pid";
        $ans=mysqli_query($connection_name,$q);
        $row=mysqli_fetch_assoc($ans);
        $profile="SiteImages/Photographer/".$row['image'];
  ?> 
            
                <div class="row">
                    
                    <div class="col-md-3">
                        <form method="post" action="" enctype="multipart/form-data">
                        <div class="profile-img">
                            <img src="<?php echo $profile; ?>" alt=""/ id="output">
                            <br>
                        <label class="text-warning">  Upload New :  </label> 
                        <input type="file" class="text-center center-block file-upload mt-2" id="fileToUpload" accept="image/*" onchange="loadFile(event)" name="profile">
                        </div>
                        <input type="submit" name="updprofile" value="Update New" class="btn btn-info mt-3">
                      </form>
                    </div>
              

             

                    <div class="col-md-8">
                        <div class="profile-head">
                 
                            <h5 class="text-primary">
                            <?php echo $row['photographer_name'];?>
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
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">My Photo</a>
                                </li>
                            </ul>
                        </div>
                   
              
                <div class="row mt-5">
                   
                    <div class="col-md-12">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <form class="form" action="##" method="post" id="editForm">
                             <div class="form-group">    
                                         
                                        <div class="row">
                                        <div class="col-md-2">
                                            <label for="photographer_name"><h6>Name</h6></label>
                                        </div>
                                        <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" id="photographer_name" value="<?php echo $row['photographer_name']; ?>">
                                        </div>
                                        </div><br/>
                                        <div class="row">
                                         <div class="col-md-2">
                                         <label for="phone"><h6>Phone</h6></label>
                                         </div>
                                         <div class="col-md-6">
                                         <input type="text" class="form-control" name="phone" id="phone" 
                                         value="<?php echo $row['phone']; ?>">
                                         </div>
                                        </div><br/>

                                          <div class="row">
                                         <div class="col-md-2">
                                         <label for="email"><h6>Email</h6></label>
                                         </div>
                                         <div class="col-md-6">
                                         <input type="email" class="form-control" id="email" value="<?php echo $row['email']; ?>" name="email">
                                         </div>
                                        </div><br/>

                                        <div class="row">
                                         <div class="col-md-2">
                                         <label for="location"><h6>Location</h6></label>
                                         </div>
                                         <div class="col-md-5">
                                         <select type="location" class="form-control" name="location" id="location">
                                         <?php
                                            $q="select * from places";
                                            $ans=mysqli_query($connection_name,$q);
                                            while ($rr=mysqli_fetch_assoc($ans)) 
                                        {if($row['place_id']==$rr['place_id'])
                                    {   
                                        ?>                                                              
                                        <option value="<?php echo $rr['place_id'];?>" selected>
                                             <?php echo $rr['place_name'];?>\
                                         </option>
                                    <?php }
                                    else{ ?>
                                        <option value="<?php echo $rr['place_id'];?>">
                                    <?php } ?>
                                        <?php echo $rr['place_name'];?>
                                        </option> 
                                        <?php }?>
                                        </select>
                                         </div>
                                        </div> <br/>

                                        <div class="row">
                                         <div class="col-md-2">
                                         <label for="experience"><h6> Experience </h6></label>
                                         </div>  
                                        <div class="col-md-5">
                                        <input type="text" class="form-control" name="exp" id="exp" 
                                         value="<?php echo $row['experience']; ?>">
                                         </div>
                                        </div><br/>

                                          <div class="row">
                                         <div class="col-md-2">
                                         <label for="experience"><h6>Description</h6></label>
                                         </div>  
                                        <div class="col-md-5">
                                        <textarea name="desc" class="form-control" rows="10">
                                         <?php echo $row['description']; ?>
                                        </textarea>
                                         </div>
                                        </div><br/>
                        <div class="row">
                            <div class="col-md-4 text-center">
                              <button class="btn btn-lg bg-primary" type="submit" name="update"><i class="glyphicon glyphicon-ok-sign"></i> Update</button>
                              <button class="btn btn-lg bg-primary" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                            </div>
                        </div>

                              </div>
              	             </form>
                            </div>

<?php 
if(isset($_GET['ptid']))
{
    $ptid=$_GET['ptid'];
    $udel=mysqli_query($connection_name,"DELETE FROM photos WHERE phototype_id=$ptid");
    if($udel)
    {
        echo "<script> location.href='edit_profile.php';</script>"; 
    }
} ?>



<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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
    $ptid=$row['phototype_id'];
    $image="SiteImages/Photo/".$row["photo_name"];
   ?>
                            <div class="col-lg-3 col-md-4 col-xs-6">
                            <a href="<?php echo $image; ?>" class="fancybox" rel="ligthbox">
                           <img  src="<?php echo $image; ?>" class="zoom img-fluid "  alt="">
                           </a><br><br>
                            <a href="?ptid=<?php echo $ptid; ?>" class="btn btn-outline-danger"> Remove </a>

                            </div>
                        <?php }} ?>
                    </div>
                   
                </div>
           </div>         
        </div>
    </div>

     </div>
        <div class="col-md-1">
        <a class="btn btn-lg bg-primary" href="profile.php" role="button" style='color: black;'>Back</a>
        </div>
    </div>





<?php require_once 'Template/footer.php'; ?>
<!-- END footer -->

<!-- loader -->
<?php require_once 'Template/loader.php'; ?>

<?php require_once 'Template/script.php'; ?>
</body>
</html>


<?php 

if(isset($_POST['update']))
{
    $n=$_POST['name'];
    $e=$_POST['email'];
    $ph=$_POST['phone'];
    $desc=$_POST['desc'];
    $desc=mysqli_real_escape_string($connection_name,$desc);
    $exp=$_POST['exp'];
    $lo=$_POST['location'];

    $pid=$_SESSION['pid'];

    $upd=mysqli_query($connection_name,"UPDATE photographers SET photographer_name='$n',email='$e',place_id=$lo,description='$desc',experience='$exp' WHERE photographer_id=$pid");
    if($upd)
    {
        echo "<script> location.href='edit_profile.php';</script>";
    }
    else
    {
        echo mysqli_error($connection_name);
    }
} ?>


 <?php 
if(isset($_POST['updprofile']))
{
    $pid=$_SESSION['pid'];
    $pimg=$_FILES['profile']['name'];
    $tmp=$_FILES['profile']['tmp_name'];
    if($tmp!=NULL)
    {
    $up=mysqli_query($connection_name,"UPDATE photographers SET image='$pimg' WHERE photographer_id=$pid");
    if($up)
    {
        move_uploaded_file($tmp,"SiteImages/Photographer/".$pimg);
        echo "<script> location.href='edit_profile.php'; </script>";
    }
    }
} ?>
