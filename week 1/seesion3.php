<?php

//     $student=['Root','basma',2013,304];
//     foreach($student as $key =>$value){
//         echo '* '.$key.' : '.$value.'<br>';
//     }


//     //Associative Array
//     $student=['name'=>'Root','id'=>'basma','num'=>2013];
//     foreach($student as $key =>$value){
//         echo '* '.$key.' : '.$value.'<br>';
//     }

//     $friend=[['name'=>'Root','id'=>'basma','num'=>2013],
//     ['name'=>'baba','id'=>'ahmed','num'=>2013],
//     ['name'=>'mama','id'=>'laila','num'=>2013]
// ];

// foreach($friend as $key =>$value){
    
    
//     foreach($value as $Keystudent =>$student){

//         echo ''.$Keystudent.' : '.$student.' ';
//     }

//     echo '<br>';
   
// }

// // Super Globals
// $age=22;
// $name='salwa';
// function getDetails(){
//     // global $age ,$name;
//     // echo "age : ".$age." name: ".$name;

//     echo "age: ".$GLOBALS['age']." name: ".$GLOBALS['name'];
// }

// getDetails();

// //$_SERVER
// echo '<br>';
// echo $_SERVER['HTTP_HOST'].'<br>';
// echo $_SERVER['SERVER_NAME'].'<br>';
// echo $_SERVER['PHP_SELF'].'<br>'; //path
// echo $_SERVER['SCRIPT_NAME'].'<br>'; //path
// echo $_SERVER['QUERY_STRING'].'<br>';
// echo $_SERVER['SERVER_ADDR'].'<br>'; //server ip
// echo $_SERVER['REMOTE_ADDR'].'<br>'; //user ip
// echo $_SERVER['REQUEST_METHOD'].'<br>'; // get-post-delete
//###############################################################

/*
-  $_POST   // POST
-  $_GET   //GET
-  $_REQUEST  //ALL 
*/

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name= $_POST['name']; // name >> ده عبارة عن النيم اللي محطوط في الفورم لكل انبوت
    $email = $_POST['email'];
    $password = $_POST['password']; 
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
    }
    if(empty($password)){
        $errors['Password']='Required';
    }


    if(count($errors)>0){
        foreach($errors as $key => $value){
            echo $key." ".$value."<br>";
        }
    }else{
        echo "Valid Data";
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
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<br>


<!-- how to send data with a link -->
<a href="action.php?id=2014&name=basma">GO TO the Link</a>
</body>
</html>