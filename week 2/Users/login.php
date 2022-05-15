<?php

require '../helpers/dbConnection.php';
require '../helpers/functions.php';


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $email = clean($_POST['email']);
    $password = clean($_POST['password']); 
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


    if(empty($password)){
        $errors['Password']='Required';
    }elseif(strlen($password)<6){
        $errors['Password']=' length should be more than 6 ';
    }


    if(count($errors)>0){
        foreach($errors as $key => $value){
            echo $key." ".$value."<br>";
        }
    }else{
        $password=md5($password);
        $sql="select * from users where email='$email' and password = '$password'";
        $op=mysqli_query($con,$sql);
        if(mysqli_num_rows($op)==1){
            //code
            $userData=mysqli_fetch_assoc($op);
            $_SESSION['user']=$userData;
            header("location: index.php");
        }else{
            echo "Error in your Cred Try Again";
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
    <div class="container">
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
  </div>

  <button type="submit" class="btn btn-primary">Login</button>
</form>

<br>


<!-- how to send data with a link -->
<!-- <a href="action.php?id=2014&name=basma">GO TO the Link</a> -->
</div>
</body>
</html>