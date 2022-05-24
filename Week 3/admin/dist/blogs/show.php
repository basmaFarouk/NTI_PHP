<?php
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checklogin.php';

########################################################################################################
////Logic
$id=$_GET['id'];
$errors=[];
$sql = "select blogs.*, category.title as cat_title, users.name from blogs inner join category on blogs.cat_id = category.id
inner join users on blogs.addedBy = users.id where blogs.id = $id";
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
            Messages("Dashboard / Users / Show");
        
        ?>
           
        </ol>

            
        <h3><?php echo $data['title'] ?></h3>
        <p>
            <?php echo $data['content'] ?>
            <br>
            <?php echo   date('Y-M-d', $data['pu_date']); ?>
            <br>

            <img src="./uploads/<?php echo $data['image']; ?>" alt="UserImage" height="400px" width="400px">
            <br>

            <?php echo $data['cat_title']; ?>
            <br>

            <?php echo $data['name']; ?>




        </p>


    </div>
</main>


<?php require '../layouts/footer.php';?>