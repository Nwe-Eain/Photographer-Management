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
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>location <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">Choose your destinations</h1>
          </div>
        </div>
      </div>
    </section>

		<section class="ftco-section ftco-agent">
    	<div class="container">
        <div class="row">
 <?php
 $pid=$_GET['pid'];

 
 $select=mysqli_query($connection_name,"SELECT * FROM photoplaces pp,photographers ph,places p
WHERE pp.place_id=$pid AND p.place_id=pp.place_id AND pp.photographer_id=ph.photographer_id");
 while($r=mysqli_fetch_assoc($select))
 {
    $img="SiteImages/Photographer/".$r['image'];
    $name=$r['photographer_name'];
    $phid=$r['photographer_id'];
    
  ?>           
    	<div class="col-md-3">
    		<div class="agent">
			<div class="img">
				<img src="<?php echo $img; ?>" class="img-fluid" alt="Colorlib Template">
			</div>
			<div class="desc">
	   <h3><a href="photographer.php?phid=<?php echo $phid; ?>"> <?php echo $name; ?></a></h3>
	    
			</div>
		</div>
    	</div>
  <?php } ?>  
        </div>
       
          </div>
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