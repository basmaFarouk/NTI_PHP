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
    //Fetch Image
    $sql="select image, addedBy from blogs where id=$id";
    $op=doQuery($sql);
    $data=mysqli_fetch_assoc($op);


    if(!(($_SESSION['user']['role_id']==1) || ($_SESSION['user']['role_id']==3 && $_SESSION['user']['id']== $data['addedBy']))){
        $message = ['Error'=>' Cant delete this'];
        $_SESSION['Message']=$message;
        header("location: index.php");
        exit;
    }

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