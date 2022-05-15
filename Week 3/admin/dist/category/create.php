<?php
###########################
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
######################################
//Logic
if($_SERVER['REQUEST_METHOD']=="POST"){
    $title=clean($_POST['title']);
    $errors=[];

    //Validation of title
    if(!validate($title,'required')){
        $errors['Title']='Required';
    }elseif(!validate($title,'min',4)){
        $errors['Title']=" length should be >=4";
    }

    //Check Errors
    if(count($errors)>0){
        $_SESSION['Message']=$errors;
    }else{

        //DB Code
        $sql="insert into category (title) values ('$title')";

        $op=doQuery($sql);

        if($op){
            $message=["Raw"=>" inserted successfully"];
        }else{
            $message=["Raw"=>" not inserted"];
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
            Messages("Dashboard / Roles / Create");
        
        ?>
           
        </ol>


        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
            <div class="mb-3" >
                <label for="exampleInputEmail1" class="form-label">Title</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="title" placeholder="Enter Your Title">
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
</main>


<?php require '../layouts/footer.php';?>