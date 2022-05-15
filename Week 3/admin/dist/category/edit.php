<?php
###########################
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
######################################
$id=$_GET['id'];
//Fetch Data
if(!validate($id,'int')){
    $messge=['id'=>' is not valid'];
    $_SESSION['Message']=$messge;
    header("location: index.php");
    exit;

}else{
    $sql="select * from category where id=$id";
    $op=doQuery($sql);

    if(mysqli_num_rows($op)==0){ //يعني حد باعت اي دي مش موجود فمرجعش داتا
        $message=["Error" => "invalid id"];
        $_SESSION['Message']=$message;
        header("location: index.php");
        exit;
    }else{
    
        $data=mysqli_fetch_assoc($op);
    }

}

//Logic
if($_SERVER['REQUEST_METHOD']=="POST"){
    $title=clean($_POST['title']);
    $errors=[];

    //Validate title
    if(!validate($title,'required')){
        $errors['Title']=' Required';

    }elseif(!validate($title,'min',4)){
        $errors['Title']=' lentgh should be >= 4';
    }

    //check errors
    if(count($errors)>0){
        $_SESSION['Message']=$errors;
    }else{
        $sql="update category set title = '$title' where id = $id";
        $op=doQuery($sql);
        if($op){
            $message=["Category"=>" updated"];
            $_SESSION['Message']=$message;
            header("location: index.php");
            exit;
        }else{
            $message=["Category"=>" not updated"];
        }
        $_SESSION['Message']=$message;
    }

}



###################################################################
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


        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?id='.$data['id'];?>" method="post" enctype="multipart/form-data">
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