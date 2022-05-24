<?php
      session_start();

    //Database Connection
    $server="localhost";
    $dbName="blog_project";
    $dbUser="root";
    $dbPassword="";
   $con = mysqli_connect($server,$dbUser,$dbPassword,$dbName); //الترتيب لازم يبقى كده ومهم
   if(!$con){
    die("error try again".mysqli_connect_error());
   }

   ///Sql Functions....
function doQuery($sql){
  
  return mysqli_query($GLOBALS['con'],$sql);
}

function Select($input){
  $input="select count(*) as count from ".$input;
  $input = doQuery($input);
  $input = mysqli_fetch_assoc($input);
  return $input;
}

?>