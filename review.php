<!DOCTYPE html>
<html lang="en">
<?php require_once 'Template/header.php'; ?>
<body>
<?php require_once 'Template/nav.php'; ?>
<!-- END nav -->

<style type="text/css">

  .checked {
  color: red;
}
  .rating {
    display: flex;
    margin-top: -10px;
    flex-direction: row-reverse;
    margin-left: -4px;
    float: left
}

.rating>input {
    display: none
}

.rating>label {
    position: relative;
    width: 19px;
    font-size: 25px;
    color: #ff0000;
    cursor: pointer
}

.rating>label::before {
    content: "\2605";
    position: absolute;
    opacity: 0
}

.rating>label:hover:before,
.rating>label:hover~label:before {
    opacity: 1 !important
}

.rating>input:checked~label:before {
    opacity: 1
}

.rating:hover>input:checked~label:before {
    opacity: 0.4
}
</style>

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
        <div class="row">
 
           
  <?php 

  $cid=$_SESSION['customer'];
  $sel=mysqli_query($connection_name,"SELECT bk.*,t.type_name,p.place_name,ph.photographer_name
FROM bookings bk,places p,photoplaces pp,types t,phototypes pt,photographers ph
WHERE bk.ppid=pp.ppid AND pp.place_id=p.place_id AND bk.phototype_id=pt.phototype_id AND pt.type_id=t.type_id AND bk.customer_id=$cid AND pt.photographer_id=ph.photographer_id AND pp.photographer_id=ph.photographer_id AND bstate=2 order by bk.booking_id DESC");
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
    $des=$r['description'];
  ?>
  <div class="col-md-4">
    <div class="card">
    <div class="card-header">
      Shoot Date : <?php echo $sdate; ?>
    </div>
    <div class="card-body">
      <h5 class="card-title">  Photographer : <?php echo $pname; ?></h5>
      <p class="card-text"> Shoot Type: <?php echo $type; ?>
        <br>
        Shoot Place :<?php echo $place; ?>
        <br>
        Shooot Time : <?php echo $shottime." - ".$stime; ?>
        <br>
        Your Request: <?php echo $des; ?>
      </p>

<?php 

$con=mysqli_query($connection_name,"SELECT * FROM ratings WHERE booking_id=$bid");
if($line=mysqli_fetch_assoc($con))
{
 ?>
      <a class="btn btn-primary" data-toggle="collapse" data-target="#seereview<?php echo $bid;?>"> View your review and rating</a>

<?php }
else{ ?>   
  <a class="btn btn-info" data-toggle="collapse" data-target="#review<?php echo $bid;?>">Leave a Review</a>
<?php } ?>

    </div>

    <div class="collapse row" id="review<?php echo $bid;?>">
                <div class="col-md-12">
                    <form accept-charset="UTF-8" action="" method="post">

                      <div class="rating"> <input type="radio" name="rating" value="5" id="5">
                        <label for="5">☆</label> 
                        <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label> 
                        <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label> 
                        <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label> 
                        <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>  
                      </div>

                        <input id="rating" name="bid" type="hidden" value="<?php echo $bid; ?>"> 

                        <textarea class="form-control animated" cols="50" id="new-review" name="comment" placeholder="Enter your review here..." rows="5"></textarea>
        
                        <div class="text-right">
                      <button class="btn btn-danger btn-sm" type="reset">Cancel</button>
                      <button class="btn btn-success btn-sm" type="submit" name="send">Send</button>
                        </div>
                    </form>
                </div>
            </div>



             <div class="collapse row" id="seereview<?php echo $bid;?>">
                <div class="col-md-12">
                    <form accept-charset="UTF-8" action="" method="post">
<?php 
$sr=mysqli_query($connection_name,"SELECT * FROM ratings WHERE booking_id=$bid");
$rrt=mysqli_fetch_assoc($sr);
$rt=$rrt['rating'];
$com=$rrt['comment'];

 ?>
                      

                        <?php 
                        for($co=1; $co<=5; $co++)
                        { 
                          if($co<=$rt)
                          {
                            echo ' <span class="fa fa-star checked"></span> ';
                          }
                          else
                          {
                            echo ' <span class="fa fa-star"></span> ';
                          }


                        } ?>
                   

                        <textarea class="form-control animated" cols="50" id="new-review" name="comment" placeholder="Enter your review here..." rows="5">
                          <?php echo $com; ?>
                        </textarea>
        
                        <div class="text-right">
                     
                        </div>
                    </form>
                </div>
            </div>
  </div>
</div>
<?php } ?>
          </div>
  






    	</div>
    </section>



    <?php 
    if(isset($_POST['send']))
    {
      $bid=$_POST['bid'];
      $rt=$_POST['rating'];
      $com=$_POST['comment'];

      $inst=mysqli_query($connection_name,"INSERT INTO ratings(booking_id,rating,comment) VALUES($bid,$rt,'$com')");
      if($inst)
      {
        echo "<script> location.href='review.php'; </script>";
      }

    }
     ?>

<?php require_once 'Template/footer.php'; ?>
<!-- END footer -->

<!-- loader -->
<?php require_once 'Template/loader.php'; ?>

<?php require_once 'Template/script.php'; ?>
<script rel='js/rating.js'></script>
</body>
</html>