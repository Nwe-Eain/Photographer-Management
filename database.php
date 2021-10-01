<?php    
    $host="localhost";
    $user="root";
    $password="";
    $dbName= "photographydb";
    $connection_name=mysqli_connect($host,$user,$password,$dbName);
   if($connection_name)
   {
       // echo"success";
   }
   else{
       echo "fail";
   } 




?>