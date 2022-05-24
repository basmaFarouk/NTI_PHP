<?php
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checklogin.php';

########################################################################################################
# Fetch Roles ..... 
$sql = "select * from roles";
$roles_op = doQuery($sql);
########################################################################################################

////Logic
$id=$_GET['id'];
$errors=[];
$sql="select * from users where id = $id";
$op=doQuery($sql);

if(mysqli_num_rows($op)==0){ //يعني حد باعت اي دي مش موجود فمرجعش داتا
    $message=["Error" => "invalid id"];
    $_SESSION['Message']=$message;
    header("location: index.php");
    exit;
}else{

    $data=mysqli_fetch_assoc($op);
}
///////////////////////

if($_SERVER['REQUEST_METHOD']=="POST"){
    $name=clean($_POST['name']);
    $email=clean($_POST['email']);
    $phone=clean($_POST['phone']);
    $role_id=clean($_POST['role_id']);
 

    //validate Name
    if(!validate($name,'required')){
        $errors['Name']="Reqired";
    }elseif(!validate($name,'min',3)){
        $errors['Name']=" Length must be >= 3";
    }

        //validate Email
        if(!validate($email,'required')){
            $errors['email']="Reqired";
        }elseif(!validate($email,'email')){
            $errors['email']=" invalid";
        }

        //validate Phone
        if(!validate($phone,'required')){
            $errors['Phone']="Reqired";
        }elseif(!validate($phone,'phone')){
            $errors['Phone']=" invalid format";
        }

                //validate Role_id
                if(!validate($role_id,'required')){
                    $errors['role_id']="Reqired";
                }elseif(!validate($role_id,'int')){
                    $errors['role_id']=" invalid";
                }

            // Validate Image
    if(validate($_FILES['image']['name'],'required')){
         if(!validate($_FILES,'image')){
             $errors['Image'] = ' Inavlid Extension';
    }}




    //Check errors
    if(count($errors)>0){
        $_SESSION['Message']=$errors;
    }else{

        if(validate($_FILES['image']['name'],'required')){
            $typesInfo  =  explode('/', $_FILES['image']['type']);   // convert string to array ... 
            $extension  =  strtolower(end($typesInfo));      // get last element in array .... 
    
            # Create Final Name ... 
            $FinalName = uniqid() . '.' . $extension;
    
            $disPath = 'uploads/' . $FinalName;
    
            $temPath = $_FILES['image']['tmp_name'];
    
            if (move_uploaded_file($temPath, $disPath)) {
                unlink('./uploads/'.$data['image']);
            }
        }else{
            $FinalName = $data['image'];
        }

        $sql="update users set name = '$name', phone= '$phone', email='$email', role_id='$role_id', image='$FinalName' where id = $id";
        $op=doQuery($sql);
        if($op){
            // $_SESSION['Message']=["Raw"=>" updated"];
            $message=["Raw" => " updated"];
            $_SESSION['Message']=$message;
            header("location: index.php");
            exit;
        }else{
            $message=["Raw"=>" not Updated"];
        }
        $_SESSION['Message']=$message;
    }

    
    
    
}
############################################################################
require '../layouts/headers.php';
require '../layouts/nav.php';
require '../layouts/sideNav.php';

?>



<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">

        <?php
            Messages("Dashboard / Users / Edit");
        
        ?>
           
        </ol>


        <form action="edit.php?id=<?php echo $data['id'];?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
                <label for="exampleInputName">Name</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="name" placeholder="Enter Name"
                value="<?php echo $data['name']?>">
                
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Email address</label>
                <input type="email" class="form-control" 
                value="<?php echo $data['email']?>" required id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Enter email">
            </div>

            <!-- <div class="form-group">
                <label for="exampleInputPassword">New Password</label>
                <input type="password" class="form-control" required id="exampleInputPassword1" name="password" placeholder="Password">
            </div> -->


            <div class="form-group">
                <label for="exampleInputEmail">Phone</label>
                <input type="text" class="form-control" value="<?php echo $data['phone']?>" required id="exampleInputEmail1" aria-describedby="emailHelp" name="phone" placeholder="Enter phone">
            </div>


            <div class="form-group">
                <label for="exampleInputPassword">Role</label>
                <select class="form-control" name="role_id">
                    <?php
                    while ($raw = mysqli_fetch_assoc($roles_op)) {
                    ?>
                        <option value="<?php echo $raw['id']; ?>" <?php if($raw['id']== $data['role_id']) {echo 'selected';}?>> <?php echo $raw['title']; ?></option>
                    <?php } ?>
                </select>
            </div>


            <div class="form-group">
                <label for="exampleInputName">Image</label>
                <input type="file" name="image">
            </div>

            <img src="uploads/<?php echo $data['image'];?>" alt="user_image" height="70px" width="70px">


            <br> <br>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
</main>


<?php require '../layouts/footer.php';?>