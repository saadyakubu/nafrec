<?php 
session_start();
//validate session, else redirect back to login page
if(empty($_SESSION['uid']))
{
    header("location:../../login.php");
}
?>