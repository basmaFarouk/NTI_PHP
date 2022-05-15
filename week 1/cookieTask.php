<?php

function Clean($input){
    $input=trim($input);
    $input=strip_tags($input);
    $input=stripslashes($input);
    return $input;
}

if($_SERVER['REQUEST_METHOD']=="POST"){
    $title=Clean($_POST['title']);
    $content=Clean($_POST['content']);
    $errors=[];




    if(empty($title)){
        $errors["Title"]="Required ";
    }elseif(strlen($title)<20){
        $errors["Title"]="length should be more than 20";
    }

    if(empty($content)){
        $errors['Content']="Required";
    
    }elseif(strlen($content)>500){
        $errors['Content']="max length is 500";
    }elseif(strlen($content)<10){
        $errors['Content']="min length is 100";
    }

    if(count($errors)>0){
        foreach($errors as $key => $value){
            echo $key." ".$value."<br>";
        }
    }else{
        setcookie('title',$title,time()+60*60,'/');
        setcookie('content',$content,time()+60*60,'/');

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
    <label for="exampleInputEmail1" class="form-label">Title</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="title">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Content</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="content">
  </div>


  <button type="submit" class="btn btn-primary">Submit</button>
</form>

</body>
</html>