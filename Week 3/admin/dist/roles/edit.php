<?php
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checklogin.php';

##############################################################################
////Logic
$id=$_GET['id'];
$errors=[];
$sql="select * from roles where id = $id";
$op=doQuery($sql);

if(mysqli_num_rows($op)==0){ //يعني حد باعت اي دي مش موجود فمرجعش داتا
    $message=["Error" => "invalid id"];
    $_SESSION['Message']=$message;
    header("location: index.php");
    exit;
}else{

    $data=mysqli_fetch_assoc($op);
}

if($_SERVER['REQUEST_METHOD']=="POST"){
    $title=clean($_POST['title']);

    //validate title
    if(!validate($title,'required')){
        $errors['Title']="Reqired";
    }elseif(!validate($title,'min',3)){
        $errors['Title']=" Length must be >= 3";
    }

    //Check errors
    if(count($errors)>0){
        $_SESSION['Message']=$errors;
    }else{
        $sql="update roles set title = '$title' where id = $id";
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
            Messages("Dashboard / Roles / Edit");
        
        ?>
           
        </ol>


        <form action="edit.php?id=<?php echo $data['id'];?>" method="post" enctype="multipart/form-data">
            <div class="mb-3" >
                <label for="exampleInputEmail1" class="form-label">Title</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="title" value="<?php echo $data['title']?>">
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
</main>


<?php require '../layouts/footer.php';?>