<?php

    if($_SERVER['REQUEST_METHOD']=="POST"){
        // //Array ( [name] => Screenshot from 2022-02-23 00-00-16.png [type] => image/png [tmp_name] => /tmp/phpVj2IqG [error] => 0 [size] => 115329 )
        // print_r($_FILES['image']);
        if(!empty($_FILES['image']['name'])){

            $name=$_FILES['image']['name'];
            $type=$_FILES['image']['type']; //  image/png
            $size=$_FILES['image']['size'];
            $tempath=$_FILES['image']['tmp_name'];

            $typesInfo = explode('/',$type);
            $extension=strtolower(end($typesInfo)); //get last element in the array
            $allowedExtension=['png','jpg','jpeg'];

        if(in_array($extension,$allowedExtension)){

            //Create Final Name
            $FinalName=time().rand().".".$extension;
            // echo $FinalName;
            // exit;

            $disPath='uploads/'.$FinalName;

            if(move_uploaded_file($tempath,$disPath)){
                echo "Image Uploaded";
            }else{
                echo "there is an error";
            }
        }else{
            echo 'invalid extension';
        }

    }else{
        echo "Image Required";
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
    <h2>Upload</h2>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
<div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Name</label>
    <input type="file" name="image">
  </div>


  <button type="submit" class="btn btn-primary">GO!!</button>
</form>

<br>


<!-- how to send data with a link -->
<a href="action.php?id=2014&name=basma">GO TO the Link</a>
</body>
</html>