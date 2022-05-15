<?php

  

    require '../helpers/dbConnection.php';
    require 'checklogin.php';
    $id = $_GET['id'];

    if($_SESSION['user']['id']!=$id){ 
    if(filter_var($id,FILTER_VALIDATE_INT)){
        //CODE
        $img = "select image from users where id = $id";
        $op1 = mysqli_query($con,$img);
        $data = mysqli_fetch_assoc($op1);

        $sql="delete from users where id = $id";
        $op=mysqli_query($con,$sql);
        if($op){
            $message = 'Raw Removed';
            unlink('uploads/'.$data['image']);
            
        }else{
            $message = 'Error Raw not Removed';
        }

    }else{
        $message = "invalid id";
    }
}else{
    $message = " can't delete your account";
}

    #set Message to Session
    $_SESSION['Message'] = $message;
    header("location: index.php");

?>