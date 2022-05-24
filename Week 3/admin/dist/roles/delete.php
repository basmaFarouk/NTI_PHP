<?php

require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checklogin.php';

##############################################################################
////Logic
$id=$_GET['id'];

//Validate ID
if(!validate($id,'int')){
    $message=["Error"=>"Invalid ID"];
}else{
    $sql="delete from roles where id=$id";
    $op=doQuery($sql);
    if($op){
        $message=["raw"=>"successfully deleted"];
    }else{
        $message=["raw"=>"not deleted please try again"];
    }
}

//Set Session
$_SESSION['Message']=$message;
header("location: index.php");
#############################################################################



?>