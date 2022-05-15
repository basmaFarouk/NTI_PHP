<?php

require '../helpers/dbConnection.php';
require '../helpers/functions.php';


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $search= clean($_POST['search']); // name >> ده عبارة عن النيم اللي محطوط في الفورم لكل انبوت

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
    if(empty($search)){
        $errors['Search name'] = "Required";
    }




    //Errors
    if(count($errors)>0){
        foreach($errors as $key => $value){
            echo $key." ".$value."<br>";
        }
    }else{
        $sql="select * from users where name like '%$search%'";
        $op=mysqli_query($con,$sql);
        if(mysqli_num_rows($op)>0){
            while($raw=mysqli_fetch_assoc($op)){
                echo "id = ".$raw['id']. " email = ".$raw['email']." name = ".$raw['name'];
            }
        }else{
            echo "no matched result";
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
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
<div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Search</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="search">
  </div>


  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<br>


<!-- how to send data with a link -->
<!-- <a href="action.php?id=2014&name=basma">GO TO the Link</a> -->
</body>
</html>