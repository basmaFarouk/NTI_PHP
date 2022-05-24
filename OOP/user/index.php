<?php

require '../classes/userClass.php';
$user= new user;
$data = $user->listUsers()


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

    <br>
    <a href="create.php">+ Account</a> || <a href="logout.php">Logout</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Password</th>
      <th scope="col"> Image </th>
      <th scope="col">action</th>
    </tr>
  </thead>
  <tbody>

    <?php
        while($raw= mysqli_fetch_assoc($data)){ //طول ما في روز في الاوبجكت اللى راجع افضل اعمل لوب
            // print_r($raw);
            // exit();
    ?>

    <tr>
            <td><?php echo $raw['id'];?></td>
            <td><?php echo $raw['name'];?></td>
            <td><?php echo $raw['email'];?></td>
            <td><?php echo $raw['password'];?></td>
            <td><img src="../uploads/<?php echo $raw['image'];?>" alt="userImage" height="70px" width="70px"></td>

      <td><a href='edit.php?id=<?php echo $raw['id'];?>' class="btn btn-primary">Edit</a>

      <!-- <?php if($_SESSION['user']['id']!=$raw['id']){ ?> -->
      <a href='delete.php?id=<?php echo $raw['id'];?>' class="btn btn-danger">Delete</a>
    
      <!-- <?php }?> -->
    </td>

    </tr>

    <?php } ?>
  </tbody>
</table>


</body>
</html>