<?php 




 function rating($pid)
{


 include 'database.php';

$sel=mysqli_query($connection_name,"SELECT SUM(rt.rating) as total FROM ratings rt,customers ct,bookings bs,photoplaces p,photographers pt,phototypes ptt,types t,places pl
WHERE bs.customer_id=ct.customer_id AND rt.booking_id=bs.booking_id AND bs.ppid=p.ppid AND ptt.phototype_id=bs.phototype_id AND p.place_id=pl.place_id AND ptt.type_id=t.type_id AND ptt.photographer_id=pt.photographer_id AND p.photographer_id=pt.photographer_id AND pt.photographer_id=$pid");

$r=mysqli_fetch_assoc($sel);
$rt=$r['total'];

$co=mysqli_query($connection_name,"SELECT COUNT(bs.customer_id) as tt FROM ratings rt,customers ct,bookings bs,photoplaces p,photographers pt,phototypes ptt,types t,places pl
WHERE bs.customer_id=ct.customer_id AND rt.booking_id=bs.booking_id AND bs.ppid=p.ppid AND ptt.phototype_id=bs.phototype_id AND p.place_id=pl.place_id AND ptt.type_id=t.type_id AND ptt.photographer_id=pt.photographer_id AND p.photographer_id=pt.photographer_id AND pt.photographer_id=$pid");

$cor=mysqli_fetch_assoc($co);
$count=$cor['tt'];

 $rating=ceil($rt/$count);

 return $rating;

}

 ?>