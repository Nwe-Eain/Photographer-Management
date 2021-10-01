<?php  include('connect.php'); ?>
<!DOCTYPE html>
<html lang="en">

<?php require_once 'head.php'; ?>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

<?php require_once 'slidebar.php'; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

         

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>



            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Htet Htet</span>
               <!-- <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60"> -->
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>

        <script type="text/javascript">
        
  function settreatments(tname,tid,tdescription)
  {
   
     document.getElementById('tname').value=tname;
     document.getElementById('tdescription').value=tdescription;
     document.getElementById('treamenttypeid').value=tid;
  

     document.getElementById('add').value="UPDATE";
     document.getElementById('add').name="updatetreatment";
  }

  function Clear()
  {
     document.getElementById('tname').value="";
     document.getElementById('tdescription').value="";
     document.getElementById('treamenttypeid').value="";
  

     document.getElementById('add').value="ADD";
     document.getElementById('add').name="addtreatment";

  }
</script>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="row">

        <div class="card col-12">
        <div class="card shadow border-0 col-md-5 mx-auto">
                <div class="card-header py-6">
                  <h6 class="m-0 font-weight-bold text-primary"> Treatment </h6>
                </div>
                <div class="card-body">
                 <form class="user" method="post" action="" enctype="multipart/form-data">
                <div class="form-group row">
                 <label> Treatment Name </label>
                    <input type="text" class="form-control" name="tname" id="tname">
               
                </div>

                <div class="form-group row">
                 <label> Treatment Type </label>
                   <select name="treamenttypeid" id="treamenttypeid" class="form-control">
                   <?php 
                   $sel = mysqli_query($con,"SELECT * FROM treatment_types");
                   while ($r=mysqli_fetch_assoc($sel)) {
                    ?>

                     <option value="<?php echo $r['treatmenttype_id']; ?>"> <?php echo $r['treaatmenttype_name']; ?></option>
                   <?php } ?>
                   </select>
               
                </div>
                  <div class="form-group row">
                 <label> Treatment Description </label>
                    <input type="text" class="form-control" name="tdescription" id="tdescription">
                </div>
                
                  
                <div class="row form-group">
                <div class="col-md-3"> Image </div>
                <div class="col-md-8">     
                <input type="file" name="timage" id="timage">
                </div>
                </div>

                <div class="form-group row">
              <input type="submit" name="addtreatment" class="btn btn-success" value="ADD" id="add">
            
                </div>
               </form>
                </div>
   </div>


      </div>
    </div>
          

<div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Treatment Name</th>
                      <th>Treatment Type</th>
                      <th>Treatment Descriptions</th>
                       <th> Image </th>
                      <th> Actions </th>
                    </tr>
                  </thead>
                  <tbody>

                  <?php 
                  $i=1;
                  $select=mysqli_query($con,"SELECT * FROM treatments t,treatment_types tt WHERE t.treatmenttype_id=tt.treatmenttype_id");
                  while ($row=mysqli_fetch_assoc($select)) {
                  ?>
                   <tr> 
                    <td> <?php echo $i; ?></td>
                    <td> <?php echo $row['treatmentname']; ?> </td>
                    <td> <?php echo $row['treaatmenttype_name']; ?> </td>
                    <td> <?php echo $row['treatment_desc']; ?> </td>
                    <td> <img src="images/<?php echo $row['image']; ?>" alt="" style="width: 100px;height: 100px;"> </td>
                    <td> <a href="?tid=<?php echo $row['treatmentid'];?>&tname=<?php echo $row['treatmentname'];?>&ttid=<?php echo $row['treatmenttype_id']; ?>&tdescription=<?php echo $row['treatment_desc'];?>" class="btn btn-success"> Update</a>
                         <a href="?tid=<?php echo $row['treatmentid'];?>&tname=<?php echo $row['treatmentname']; ?>&tdescription=<?php echo $row['treatment_desc'];?>&act=1" class="btn btn-danger"> Delete</a>
                    </td>
                  </tr>
                   <?php 
                   $i++;} ?>
                  </tbody>
                </table>
              </div>
            </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

<?php require_once 'footer.php';?>

</body>

</html>


<?php 

$tid;
if(isset($_POST['addtreatment']))
{
  $tname= $_POST['tname'];
  $ttid=$_POST['treamenttypeid'];
  $tdescription=$_POST['tdescription'];
  $image = $_FILES['timage']['name'];
  $tmp = $_FILES['timage']['tmp_name'];
  $location = "images/$image";

  $ext=strtolower(pathinfo($image,PATHINFO_EXTENSION));
  echo $ext;

  if($ext!= "jpg" && $ext!="png" && $ext!="jpeg")
  {
    echo "<script> alert('Wrong File Format'); </script>";
  }
  elseif (file_exists($location)) {
    echo "<script> alert('Image File Already exist'); </script>";
  }

  else
  {

  $insert=mysqli_query($con,"INSERT INTO treatments(treatmentname,treatmenttype_id,treatment_desc,image) VALUES('$tname',$ttid,'$tdescription','$image')");
  if($insert)
  {
    move_uploaded_file($tmp, $location);
    echo"<script> alert('Added'); location.assign('treatment.php');</script>";
  }
  else
  {
    echo"<script> alert('error'); </script>";
  }
  }
}

if(isset($_GET['tid']))
{

 $tid = $_GET['tid'];

  if($_GET['tname'])
  {
 
  $ttname = $_GET['tname'];
  $ttid = $_GET['ttid'];
  $tdes= $_GET['tdescription'];
 

 echo "<script> settreatments('$ttname','$treatmenttype_id','$tdes'); </script>";

  }


  if(isset($_GET['act']))
  {
    echo "<script> alert('Deleted');</script>";
      $delete = mysqli_query($con,"DELETE FROM treatments WHERE treatmentid=$ttid");
      
      if($delete)
      {
          echo"<script> location.assign('treatment.php'); </script>";
      }
  }

}

if(isset($_POST['updatetreatment']))
{
  $tname= $_POST['tname'];
  $ttid =$_POST['treamenttypeid'];
  $tdescription=$_POST['tdescription'];
  $image = $_FILES['timage']['name'];
  $tmp = $_FILES['timage']['tmp_name'];
  $location = "images/$image";



  if($tmp==NULL)
  {
   

    $upt=mysqli_query($con,"UPDATE treatments SET treatmentname='$tname',treatmenttype_id=$ttid,treatment_desc='$tdescription' WHERE treatmentid=$tid");
  if($upt)
  {
   
    echo"<script> alert('Treatments Updated'); Clear(); location.assign('treatment.php'); </script>";
  }
  else
  {
    echo"<script> alert('error'); </script>";
  }
  }


  else
  {

    $ext=strtolower(pathinfo($image,PATHINFO_EXTENSION));

  if($ext!= "jpg" && $ext!="png" && $ext!="jpeg")
  {
    echo "<script> alert('Wrong File Format'); </script>";
  }
  elseif (file_exists($location)) {
    echo "<script> alert('Image File Already exist'); </script>";
  } 

  else
  {

 $upt=mysqli_query($con,"UPDATE treatments SET treatmentname='$tname',treatmenttype_id=$ttid,treatment_desc='$tdescription',image='$image' WHERE treatmentid=$tid");
  if($upt)
  {
    move_uploaded_file($tmp, $location);
    echo"<script> alert('Success'); location.assign('treatment.php'); </script>";
  }
  else
  {
    echo"<script> alert('error'); </script>";
  }

  }
}

}

 ?>



