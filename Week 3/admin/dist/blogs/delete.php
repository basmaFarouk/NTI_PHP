<?php

require '../helpers/dbConnection.php';
require '../helpers/functions.php';

##############################################################################
////Logic
$id=$_GET['id'];

//Validate ID
if(!validate($id,'int')){
    $message=["Error"=>"Invalid ID"];
}else{
    //Fetch Image
    $sql="select image from blogs where id=$id";
    $op=doQuery($sql);
    $data=mysqli_fetch_assoc($op);

    $sql="delete from blogs where id=$id";
    $op=doQuery($sql);
    if($op){
        removeFile($data['image']);
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