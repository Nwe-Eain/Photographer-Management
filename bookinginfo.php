<!DOCTYPE html>
<html lang="en">
<?php require_once 'Template/header.php'; ?>
<body>
<?php require_once 'Template/nav.php'; ?>
<!-- END nav -->

 <section class="hero-wrap hero-wrap-2 ftco-degree-bg js-fullheight" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate pb-5 text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Booking <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread"> Booking Info </h1>
          </div>
        </div>
      </div>
    </section>

		<section class="ftco-section ftco-agent">
    	<div class="container">

  <a href="review.php" class="btn btn-info mb-3"> Make a review </a>
        <div class="row">
          <div class="table">
            <table class="table table-bordered">
              <thead>
                <th> No </th>
                <th> Booking Date </th>
                <th> Photographer </th>
                <th> Shoot Type </th>
                <th> Shoot Place </th>
                <th> Shoot Time </th>
                <th> Shoot Date </th>
                <th> Descriptoin </th>
                <th> Status </th>
              </thead>

              <tbody>
  <?php 
  $no=1;
  $cid=$_SESSION['customer'];
  $sel=mysqli_query($connection_name,"SELECT bk.*,t.type_name,p.place_name,ph.photographer_name
FROM bookings bk,places p,photoplaces pp,types t,phototypes pt,photographers ph
WHERE bk.ppid=pp.ppid AND pp.place_id=p.place_id AND bk.phototype_id=pt.phototype_id AND pt.type_id=t.type_id AND bk.customer_id=$cid AND pt.photographer_id=ph.photographer_id AND pp.photographer_id=ph.photographer_id order by bk.booking_id DESC");
  while($r=mysqli_fetch_assoc($sel))
  { 
    $bid=$r['booking_id'];
    $bdate=$r['bookingdate'];
    $sdate=$r['shoot_date'];
    $stime=$r['stime'];
    $shottime=$r['shoot_time'];
    $pname=$r['photographer_name'];
    $bstate=$r['bstate'];
    $place=$r['place_name'];
    $type=$r['type_name'];
  ?>
                <tr>
                  <td> <?php echo $no; $no++; ?></td>
                  <td> <?php echo $bdate; ?></td>
                  <td> <?php echo $pname; ?></td>
                  <td> <?php echo $type; ?></td>
                  <td> <?php echo $place; ?></td>
                  <td> <?php echo $sdate; ?></td>
                  <td> <?php echo $stime." - ".$shottime; ?></td>
                  <td> <?php echo $r['description']; ?></td>
                  
                  <td> <?php
                  if($bstate==1)
                  {
                    echo "<a href='?bid=$bid&sdate=$sdate' class='btn btn-info'> Cancel </a>";
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
  
<?php if(isset($_GET['bid']))
{
  $bid=$_GET['bid'];
  $s=date_create($_GET['sdate']);
  $sdate=date_format($s,"Y-m-d");
  $ssd=new DateTime($sdate);
  $today=date('Y-m-d');
  $td=new DateTime($today);
  $dt=date_diff($ssd,$td)->format("%a");

  if($dt>=2)
  {
  $upd=mysqli_query($connection_name,"UPDATE bookings SET bstate=0 WHERE booking_id=$bid");
  if($upd)
  {
    echo "<script> alert('Booking Cancel Succesfful'); location.href='bookinginfo.php'; </script>";
  }
  }
  else
  {
    echo "<script> alert('You cannot cancel by booking. Only cancel before two days of your shoot_date'); </script>";
  }

} ?>

        </div>
    	</div>
    </section>

<?php require_once 'Template/footer.php'; ?>
<!-- END footer -->

<!-- loader -->
<?php require_once 'Template/loader.php'; ?>

<?php require_once 'Template/script.php'; ?>
</body>
</html>