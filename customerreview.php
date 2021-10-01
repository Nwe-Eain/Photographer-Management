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
</style>
 <section class="hero-wrap hero-wrap-2 ftco-degree-bg js-fullheight" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate pb-5 text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Reviews and Rating <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">Check Our Customer Reviews and Ratings </h1>
          </div>
        </div>
      </div>
    </section>

		<section class="ftco-section ftco-agent">
    	<div class="container">
 

   <div class="table">
                            <table class="table table-stripped">
                                <thead style="font-size: 13px;">
                                    <th> No </th>
                                    <th> Customer </th>
                                    <th> Contact No  </th>
                                    <th> Review </th>
                                    <th> Rating </th>
                                    
                                </thead>
                                <tbody>
    <?php 
    $no=1;
    $aname;
    $se=mysqli_query($connection_name,"SELECT rt.*,ct.customer_name,ct.phone FROM ratings rt,customers ct,bookings bs,photoplaces p,photographers pt,phototypes ptt,types t,places pl
WHERE bs.customer_id=ct.customer_id AND rt.booking_id=bs.booking_id AND bs.ppid=p.ppid AND ptt.phototype_id=bs.phototype_id AND p.place_id=pl.place_id AND ptt.type_id=t.type_id AND ptt.photographer_id=pt.photographer_id AND p.photographer_id=pt.photographer_id ORDER BY rt.rating_id DESC");
    while($r=mysqli_fetch_assoc($se))
    {
        $n=$r['customer_name'];
        $ph=$r['phone'];
        $com=$r['comment'];
        $rating=$r['rating'];

   
     ?>
                                    <tr>
                                    <td><?php echo $no;$no++; ?></td>
                                    <td><?php echo $n; ?></td>
                                    <td><?php echo $ph; ?></td>
                                    <td><?php echo $com; ?></td>
                                  <td>  
                    <?php 
                    for($i=1;$i<=5;$i++)
                {
                    if($i<=$rating)
                        {?>

                <span class="fa fa-star checked"></span>
                <?php
            }
            else
                {
                echo '<span class="fa fa-star"></span>';

                }}
                ?>
                </td>
            </tr>
                    
                    <?php } ?> </tbody>
                </table>
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