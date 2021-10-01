
<!DOCTYPE html>
<html lang="en">
<?php 
require_once 'Template/header.php'; ?>
<body>
<?php

if(isset($_POST["signin"])){
    $email= $_POST['inputEmail'];
    $password= $_POST['inputPassword'];

    $password=md5($password);
    $q="SELECT * from photographers where email='$email' AND password='$password'";
    $result=mysqli_query($connection_name,$q);
    $row=mysqli_num_rows($result);
   
    if($row>0)
    {
         $array=mysqli_fetch_assoc($result);
        if ($array['allowstate']==1)
        {
            echo"<script> alert('Your account is pending state and wait to accept!'); </script>";
        }
        elseif($array['allowstate']==2)
        {
            $_SESSION['pid']=$array['photographer_id'];
            echo"
            <script> alert('Login Successful'); location.href='profile.php';</script>";
        }
    }
    else
    {
        echo mysqli_error($connection_name);
    }
}
?>


<div class="hero-wrap ftco-degree-bg" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Sign In</h5>
                    <form class="form-signin" method="POST">
                        <div class="form-label-group">
                        <label for="inputEmail">Email address</label>
                            <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                            
                        </div>

                        <div class="form-label-group">
                        <label for="inputPassword">Password</label>
                            <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>

                        </div> <br/>
                        <div class='text-center'>
                        <button name="signin" class="btn btn-lg bg-primary text-uppercase" type="submit" > Sign in</button>
                        <button name="reset" class="btn btn-lg bg-primary text-uppercase" type="reset" > Clear</button>
                        </div>
                        <hr class="my-4">
                        <div class="d-flex justify-content-center links">
                            Don't have an account? <a href="register.php" class="ml-2">Sign Up</a>
                        </div>
                        <div class="d-flex justify-content-center links">
                            <a href="#">Forgot your password?</a><br/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<!-- loader -->
<?php require_once 'Template/loader.php'; ?>

<?php require_once 'Template/script.php'; ?>


</body>
</html>