

<!DOCTYPE html>
<html lang="en">
<?php require_once 'Template/header.php'; ?>
<body>

<div class="container register" style="margin-top:20px">
                <div class="row">
                    <div class="col-md-11 ">
                        <a class="navbar-brand" >
                        <img src="images/logo.png" alt="logo" style="width:100px;">
                         </a>
                         <a class="navbar-brand" ><i> Click & Capture</i></a>                   
                    </div>
                    <div class="row">
                    <div class="col-md-1 register-right">
                    <a class="btn btn-lg bg-primary" href="memberform.php" role="button" style='color: black;'>Back</a>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-3 register-left">
                    <h3>Welcome!!!</h3>
                         <h6>Already have an account?
                             <a href="login.php">Log in Here</a>
                         </h6>
                    </div>


                   


                    <div class="col-md-9 register-right" >

 <?php
                    if(isset($_POST["btnregister"]))
                    {
                      $photographer_name= $_POST['photographer_name'];
                      $phone= $_POST['phone'];
                      $location=$_POST['location'];
                      $email= $_POST['email'];
                      $password= $_POST['password'];
                      $confirmpassword= $_POST['confirmpassword'];
                      $pimg=$_FILES['pimg']['name'];
                      $temp=$_FILES['pimg']['tmp_name'];
                      $exp= $_POST['exp'];
                      $des=$_POST['des'];

                      if($password != $confirmpassword)
                      {
                         echo "<h1 class='text-danger'> Your passwords did not match!!!</h1>";
                      }
                      else{
                        $q="SELECT photographer_id FROM photographers WHERE email='$email'";
                        $ans=mysqli_query($connection_name,$q);
                        $r=mysqli_num_rows($ans);
                        if($r>0)
                         {
                          echo "<h1 class='text-danger'> Your Email is already exit!!!</h1>";
                         }
                         else
                         {

                          $password_d=md5($password);
                         
                  $query="INSERT INTO photographers(photographer_name,place_id,image,email,phone,experience,description,password,allowstate) VALUES('$photographer_name',$location,'$pimg','$email','$phone','$exp','$des','$password_d',1)";
                  $res=mysqli_query($connection_name,$query);  
                      if($res)
                      {

                        move_uploaded_file($temp,"SiteImages/Photographer/".$pimg);
                         echo"<h1 class='text-success'> Successfully Registered!</h1>";
                      }                      
                         
                        }
                      }
                    }
                    ?>


                        
                       <h3 class="register-heading">Apply as a Member</h3>
             <form class="form" action="" method="post" id="editForm" enctype="multipart/form-data">
                             <div class="form-group" >            
                                <div class="row">
                                <div class="col-md-2">
                                <label for="photographer_name"><h6>Name</h6></label>
                                </div>  
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="photographer_name" id="photographer_name" placeholder="enter your name" title="enter your name." required="required">
                                </div>
                                </div><br/>

                
                                <div class="row">
                                 <div class="col-md-2">
                                 <label for="phone"><h6>Phone</h6></label>
                                 </div>  
                                <div class="col-md-5">
                                 <input type="text" class="form-control" name="phone" id="phone" placeholder="enter phone" title="Enter your phone number if any." required="required">
                                 </div>
                                </div><br/>

                                        <div class="row">
                                         <div class="col-md-2">
                                         <label for="email"><h6>Email</h6></label>
                                         </div>  
                                        <div class="col-md-5">
                                         <input type="email" class="form-control" id="email" placeholder="you@email.com" title="enter your email." required="required" name="email">
                                         </div>
                                        </div><br/>

                                       

                                        <div class="row">
                                         <div class="col-md-2">
                                         <label for="password"><h6>Password</h6></label>
                                         </div>  
                                        <div class="col-md-5">
                                         <input type="password" class="form-control" name="password" id="password" placeholder="password" title="enter your password." required="required">
                                         </div>
                                        </div><br/>

                                        <div class="row">
                                         <div class="col-md-2">
                                         <label for="confirmpassword"><h6>Verify</h6></label>
                                         </div>  
                                        <div class="col-md-5">
                                         <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="verify password" title="enter your verify password." required="required">
                                         </div>
                                        </div><br/>


                                        <div class=" col-md-6 custom-control custom-checkbox mb-3">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1" required="required">
                                        <label class="custom-control-label" for="customCheck1">I agree  with <a href="memberform.php" >Terms and Coditions</a></label>
                                        </div>

                                        <input type="submit" name="btnregister" class="btnRegister btn btn-primary"  value="Register"/>
                                        <input type="reset" class="btnReset btn btn-primary"  value="Clear"/>
                                          
                            </div>
                        </form>
          
                    </div>


<?php require_once 'Template/footer.php'; ?>
<!-- END footer -->

<!-- loader -->
<?php require_once 'Template/loader.php'; ?>

<?php require_once 'Template/script.php'; ?>
</body>
</html>

<?php

