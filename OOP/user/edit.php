<?php
require '../classes/userClass.php';


########################################################################################################


////Logic
$id=$_GET['id'];
$userData= new user;
$data =$userData->getData($id);

if($_SERVER['REQUEST_METHOD']=="POST"){
   $result= $userData->update($_POST,$_FILES,$id);
   foreach($result as $key=>$value){
       echo "* ".$key." : ".$value."<br>";
   }
}






############################################################################


?>



<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">


           
        </ol>


        <form action="edit.php?id=<?php echo $data['id'];?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
                <label for="exampleInputName">Name</label>
                <input type="text" class="form-control"  id="exampleInputName" aria-describedby="" name="name" placeholder="Enter Name"
                value="<?php echo $data['name']?>">
                
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Email address</label>
                <input type="email" class="form-control" 
                value="<?php echo $data['email']?>"  id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Enter email">
            </div>

            <!-- <div class="form-group">
                <label for="exampleInputPassword">New Password</label>
                <input type="password" class="form-control" required id="exampleInputPassword1" name="password" placeholder="Password">
            </div> -->





            <div class="form-group">
                <label for="exampleInputName">Image</label>
                <input type="file" name="image">
            </div>

            <img src="../uploads/<?php echo $data['image'];?>" alt="user_image" height="70px" width="70px">


            <br> <br>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
</main>


