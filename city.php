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
 $total_pages;
$total_pages_sql;
if (isset($_GET['pageno'])) {
 $pageno = $_GET['pageno'];
} 
else 
{
    $pageno = 1;
}
$no_of_records_per_page = 8;
$offset = ($pageno-1) * $no_of_records_per_page;

$total_pages_sql = "SELECT COUNT(*) FROM places";

$result = mysqli_query($connection_name,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die();
}
 $select=mysqli_query($connection_name,"SELECT COUNT(photoplaces.photographer_id) as tt,places.* FROM photoplaces,places,photographers ph WHERE places.place_id=photoplaces.place_id AND ph.photographer_id=photoplaces.photographer_id AND ph.allowstate=2 GROUP By photoplaces.place_id LIMIT $offset, $no_of_records_per_page");
 while($r=mysqli_fetch_assoc($select))
 {
    $img="SiteImages/Place/".$r['place_img'];
    $place=$r['place_name'];
    $pid=$r['place_id'];
    $c=$r['tt'];
  ?>           
    	<div class="col-md-3">
    		<div class="agent">
			<div class="img">
				<img src="<?php echo $img; ?>" class="img-fluid" alt="Colorlib Template">
			</div>
			<div class="desc">
	   <h3><a href="cityphoto.php?pid=<?php echo $pid; ?>"> <?php echo $place; ?></a></h3>
	    <p class="h-info"><span class="location">List</span> 
        <span class="details">&mdash; <?php echo $c; ?> Photographers</span></p>

			</div>
		</div>
    	</div>
  <?php } ?>  
        </div>
        <div class="row mt-5">
          <div class="col text-center">
            <div class="block-27">
              <ul>
                 <?php 
    if ($total_pages <= 10)
      {       
    for ($counter = 1; $counter <= $total_pages; $counter++)
    {
    if ($counter == $pageno) 
    {
 ?>
   <li class='active'> <a> <?php echo $counter; ?></a> </li>
    <?php 
    
    }

    elseif($counter == $total_pages)
    {
    ?>
<li>
  <a href="?pageno=<?php echo $total_pages; ?>"> <?php echo $counter; ?> </a>
   </li>

    <?php  
 
  }
     else  
   {
     ?>       
           
        <li>  <a href="?pageno=<?php echo $counter; ?>"> <?php echo $counter; ?> </a></li>
 <?php 
  }
 }
}
   ?>
              </ul>
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