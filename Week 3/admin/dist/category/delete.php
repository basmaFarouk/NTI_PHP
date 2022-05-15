<?php
require '../helpers/functions.php';
require '../helpers/dbConnection.php';

$id=$_GET['id'];
if(!validate($id,'int')){
    $message=['id'=>' is inavlid'];
}else{
    $sql="delete from category where id = $id";
    $op=doQuery($sql);
    if($op){
        $message=["Raw"=>" removed"];
    }else{
        $message=["Raw"=>" not removed"];
    }

}

//Set Session
$_SESSION['Message']=$message;
header("location: index.php");

?>