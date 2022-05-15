<?php

require '../helpers/dbConnection.php';
require 'checklogin.php';
require '../helpers/functions.php';

#################################
////Fetch Department Data
$dep_sql="select * from departments";
$dep_op=mysqli_query($con,$dep_sql);
##############################################

$id=$_GET['id'];
$sql="select * from users where id = $id";
$op=mysqli_query($con,$sql);
$data=mysqli_fetch_assoc($op);
// $img=$data['image'];
// print_r($img);
// exit();



if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name= clean($_POST['name']); // name >> ده عبارة عن النيم اللي محطوط في الفورم لكل انبوت
    $email = clean($_POST['email']);
    $dep_id=clean($_POST['dep_id']);
    // $password = (int)$_POST['password'];  // casting >> بحوله لنوع انتجر
    $errors=[];
    // if($email ==null && $name == null){
    //     echo "your name and your email shouldn't be null";
    // }
    // elseif($email == null){
    //     echo "your email shouldn't be null";
    // }elseif($name == null){
    //     echo "your name shouldn't be null";
    // }
    // else{
    //     echo "your data is valid";
    // }


    //Another Solution
    if(empty($name)){
        $errors['Name'] = "Required";
    }
    if(empty($email)){
        $errors['Email'] = 'Required';
    }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $email=filter_var($email,FILTER_SANITIZE_EMAIL);
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            echo "your email ".$email." is invalid";
        }else{
            echo "try to write like this email ".$email;
        }
        // echo $email;
        // $errors['Email']="Not Valid";
    }else{
        echo "your email is valid";
    }

    //Validate Image
    if(!empty($_FILES['image']['name'])){
        $typesInfo = explode('/',$_FILES['image']['type']); //array
        $extensions = strtolower(end($typesInfo));
        $allowedExtensions = ['png','jpg','jpeg'];

        if(!in_array($extensions,$allowedExtensions)){
            $errors['image']="invalid extension";
        } 
    }


        //Validate DEP_ID
        if(empty($dep_id)){
            $errors['Department'] ="Required";
        }elseif(!filter_var($dep_id,FILTER_VALIDATE_INT)){
            $errors['Department']="invalid Dep id format";
        }
 


    if(count($errors)>0){
        foreach($errors as $key => $value){
            echo $key." ".$value."<br>";
        }
    }else{
        // $img=$data['image'];
    if(!empty($_FILES['image']['name'])){

        $finalName = uniqid() . '.' . $extensions;
        $disPath = 'uploads/' . $finalName;
        $tempath=$_FILES['image']['tmp_name'];
        if(move_uploaded_file($tempath,$disPath)){

            unlink('uploads/'.$data['image']);
        }
    }else{
        $finalName=$data['image'];
    }

        $sql= "update users set name='$name', email='$email', image='$finalName', dep_id=$dep_id where id=$id";
        $op=mysqli_query($con,$sql);
        if($op){
            $message="Raw Updated";
            $_SESSION['Message']=$message;
            header("location: index.php");
        }else{
            echo "error try again".mysqli_error($con);
        }
    

        //Close Connection
        mysqli_close($con);
        
    }

}


?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?id='.$data['id'];?>" method="post" enctype="multipart/form-data">
<div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" value="<?php echo $data['name']?>">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?php echo $data['email']?>">
  </div>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Image</label>
    <input type="file" name="image">
  </div>

  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Department</label>
    <select  class="form-control" name="dep_id">

    <?php while($raw=mysqli_fetch_assoc($dep_op)){ ?>
        <option value="<?php echo $raw['id']?>" <?php if($data['dep_id']==$raw['id']) {echo "selected";} ?>><?php echo $raw['title'] ?></option>

    <?php } ?>
    </select>
  </div>

  <!-- <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
  </div> -->

  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<br>


<!-- how to send data with a link -->
<a href="action.php?id=2014&name=basma">GO TO the Link</a>
</body>
</html>

