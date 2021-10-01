<?php 
session_start();
unset($_SESSION['pid']);

header("location:index.php"); ?>