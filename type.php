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
            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Type <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">Choose Photography Type</h1>
          </div>
        </div>
      </div>
    </section>

        <section class="ftco-section ftco-agent">
        <div class="container">
        <div class="row">
 <?php 
 
 $select=mysqli_query($connection_name,"SELECT COUNT(phototypes.photographer_id) as tt,types.* FROM phototypes,types,photographers ph WHERE types.type_id=phototypes.type_id AND ph.photographer_id=phototypes.photographer_id AND ph.allowstate=2 GROUP By phototypes.type_id");
 while($r=mysqli_fetch_assoc($select))
 {
    $img="SiteImages/Type/".$r['image'];
    $type=$r['type_name'];
    $tid=$r['type_id'];
    $count=$r['tt'];
  ?>           
        <div class="col-md-3">
            <div class="agent">
            <div class="img">
                <img src="<?php echo $img; ?>" class="img-fluid" alt="Colorlib Template">
            </div>
            <div class="desc">
       <h3><a href="typephoto.php?tid=<?php echo $tid; ?>"> <?php echo $type; ?></a></h3>
        <p class="h-info"><span class="location">List</span> 
          <span class="details">&mdash; <?php echo $count; ?> Photographers</span></p>
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