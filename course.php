<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="bootstrap4/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/mystyle.css">
	<script type="text/javascript" src="bootstrap4/js/bootstrap.min.js"></script>
</head>
<body>
<?php 
	include 'db.php';
 ?>
<div class="container">
	<div class="row">
		<?php 
			$q="SELECT cname,cimage,cduration,count(*)
FROM courses,student_courses
where courses.cid=student_courses.cid 
group by student_courses.cid
order by count(*) desc";
			$ans=mysqli_query($cn,$q);
			while($row=mysqli_fetch_assoc($ans))
			{
				$course=$row["cname"];
				$duration=$row["cduration"];
				$image="images/".$row["cimage"];
		?>
			<div class="col-md-5 text-center bg-danger p-3">
			<div>
				<img src="<?php echo $image;?>" alt="image not found" class="container-fluid">
			</div>
			<div class="mb-3 item">
				course : <?php echo $course; ?>
			</div>
			<div class="mb-3 item">
				duration : <?php echo $duration; ?>
			</div>
			<div>
				<a href="register.php" class="btn btn-primary">Register</a>
				<a href="detials.php" class="btn btn-success">Details>></a>
			</div>

		</div>

		<?php
			}
		 ?>


		


	</div>
</div>
</body>
</html>