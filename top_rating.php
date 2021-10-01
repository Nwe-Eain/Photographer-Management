<?php include 'database.php';
include('ratingcal.php'); ?>


<style type="text/css">
    .checked {
  color: red;
}
</style>

<section class="ftco-section ftco-agent">
    	<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 heading-section text-center ftco-animate mb-5">
                <span class="subheading">Our Rating</span>
                <h2 class="mb-2">The Top Rating photographers</h2>
            </div>
        </div>
        <div class="row">
        <?php 
			$q="SELECT SUM(rt.rating) as total,pt.photographer_id as pit,pt.* FROM ratings rt,customers ct,bookings bs,photoplaces p,photographers pt,phototypes ptt,types t,places pl
WHERE bs.customer_id=ct.customer_id AND rt.booking_id=bs.booking_id AND bs.ppid=p.ppid AND ptt.phototype_id=bs.phototype_id AND p.place_id=pl.place_id AND ptt.type_id=t.type_id AND ptt.photographer_id=pt.photographer_id AND p.photographer_id=pt.photographer_id GROUP BY pit ORDER BY total DESC LIMIT 6";
			$ans=mysqli_query($connection_name,$q);
			while($row=mysqli_fetch_assoc($ans))
			{
				$name=$row["photographer_name"];
				
				$image="SiteImages/Photographer/".$row["image"];
                $pid=$row['pit'];
		?>
        	<div class="col-md-3">
        		<div class="agent">
    					<div class="img">
                        <img src="<?php echo $image;?>" alt="image not found" class="container-fluid">
	    				</div>
	    				<div class="desc">
                        <div>
                        Name:<?php echo $name; ?>
                        </div>
                      
       <p class="proile-rating">
                                    
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
                                      <a href="photographer.php?phid=<?php echo $pid; ?>" class="btn btn-primary">Detail</a>

	    				</div>
    				</div>
                </div>
                <?php
			}
		 ?>
            </div>
        </div>
</section>