<?php

session_start();

class DB{
    var $server = "localhost";
    var $dbName = "oopTask";
    var $dbUser = "root";
    var $dbPassword ="";
    var $con;

     function __construct(){
       $this->con = mysqli_connect($this->server,$this->dbUser,$this->dbPassword,$this->dbName); //الترتيب لازم يبقى كده ومهم
       if(!$this->con){
        echo "error try again".mysqli_connect_error();
       }     
     }


     function doQuery($sql){
    
       return mysqli_query($this->con,$sql);
      
      }
  
  
  
      function __destruct()
      {
            mysqli_close($this->con);
      }
  }

?>