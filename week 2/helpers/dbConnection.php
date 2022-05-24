<?php
      session_start();

    //Database Connection
    $server="localhost";
    $dbName="nti";
    $dbUser="root";
    $dbPassword="";
   $con = mysqli_connect($server,$dbUser,$dbPassword,$dbName); //الترتيب لازم يبقى كده ومهم
   if(!$con){
    echo "error try again".mysqli_connect_error();
   }




?>