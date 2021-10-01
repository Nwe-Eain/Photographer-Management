<!DOCTYPE html>
<html lang="en">
<?php require_once 'Template/header.php'; ?>
<body>
<?php require_once 'Template/nav.php'; ?>
<!-- END nav -->

<div class="container" style="margin-top:150px">

<?php require_once 'Template/aboutmembership.php'; ?>
<!-- END aboutmembership -->

<div class="col-lg-15" style="margin-top:40px">
    <div class="card-deck">
    <div class="card bg-primary">
      <div class="card-body text-center">
        <p class="card-text" style='color: black;' >Some text inside the first card</p>     
      </div>
      </div>
      <div class="card bg-primary">
      <div class="card-body text-center">
        <p class="card-text" style='color: black;' >Some text inside the first card</p>     
      </div>
      </div>
      </div>
      
      <a href="register.php" class="bg-primary btn-lg" role="button" style='color: black; margin-left: 40%; margin-right: 40%; display: block;margin-top: 20px; text-align:center;' >
      Register Here!!!</a>
     
      </div>
</div>

<?php require_once 'Template/footer.php'; ?>
<!-- END footer -->

<!-- loader -->
<?php require_once 'Template/loader.php'; ?>

<?php require_once 'Template/script.php'; ?>
</body>
</html>