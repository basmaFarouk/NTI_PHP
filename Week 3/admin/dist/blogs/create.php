<?php
########################################################################################################
require '../helpers/dbConnection.php';
require '../helpers/functions.php';

########################################################################################################
# Fetch Roles ..... 
$sql = "select * from category";
$cat_op = doQuery($sql);
########################################################################################################


// LOGIC .... 

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    # FETCH && CLEAN DATA .... 
    $title   = Clean($_POST['title']);
    $content = Clean($_POST['content']);
    $cat_id  = Clean($_POST['cat_id']);
    $date    = Clean($_POST['date']);
    // echo $date;
    // print_r(explode('-',$date));
    // // exit;

    # Error [] 
    $errors = [];

    # Validate Title ....  
    if (!validate($title, 'required')) {
        $errors['Title'] = "Field Required";
    } elseif (!validate($title, 'min', 3)) {
        $errors['Title'] = "Field Length must be >= 2 chars";
    }

        # Validate Content ....  
        if (!validate($content, 'required')) {
            $errors['Content'] = "Field Required";
        } elseif (!validate($content, 'min', 10)) {
            $errors['Content'] = "Field Length must be >= 10 chars";
        }


    # Validate cat_id 
    if (!validate($cat_id, 'required')) {
        $errors['Category'] = "Field Required";
    } elseif (!validate($cat_id, 'int')) {
        $errors['Category'] = "Invalid Id";
    }


    # Validate Date 
    if (!validate($date, 'required')) {
        $errors['Date '] = "Field Required";
    } elseif (!validate($date, 'date')) {
        $errors['Date '] = "InValid Format";
    }elseif (!validate($date, 'DateNext')) {
        $errors['Date '] = "InValid Date";
    }


    // Validate Image
    if(!validate($_FILES['image']['name'],'required')){
        $errors['Image']=' Required';

    }elseif(!validate($_FILES,'image')){
        $errors['Image'] = ' Inavlid Extension';
    }

    # Check Errors .... 
    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {

        # DB CODE ..... 

        $typesInfo  =  explode('/', $_FILES['image']['type']);   // convert string to array ... 
        $extension  =  strtolower(end($typesInfo));      // get last element in array .... 

        # Create Final Name ... 
        $FinalName = uniqid() . '.' . $extension;

        $disPath = 'uploads/' . $FinalName;

        $temPath = $_FILES['image']['tmp_name'];

        if (move_uploaded_file($temPath, $disPath)) {

            $date = strtotime($date);
            $user_id=$_SESSION['user']['id'];
            $sql = "insert into blogs (`title`, `content`, `image`, `pu_date`, `cat_id`, `addedBy`) values ('$title','$content','$FinalName',$date,$cat_id,$user_id)";
            $op  = doQuery($sql);

            if ($op) {
                $message = ["success" => "Raw Inserted"];
            } else {
                $message = ["Error" => "Try Again"];
            }
        } else {
            $message = ["Error" => "In Uploading try Again"];
        }
        $_SESSION['Message'] = $message;
    }
}
########################################################################################################

require '../layouts/headers.php';
require '../layouts/nav.php';
require '../layouts/sideNav.php';

?>

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">


            <?php
            # Print Messages .... 
            Messages('Dashboard / Blogs / Create');
            ?>


        </ol>


        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">Title</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="title" placeholder="Enter Name">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Content</label>
                <textarea type="email" class="form-control" required id="exampleInputEmail1" aria-describedby="emailHelp" name="content" placeholder="Enter your content"></textarea>
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Date</label>
                <input type="date" class="form-control" required id="exampleInputEmail1" aria-describedby="emailHelp" name="date">
            </div>


            <div class="form-group">
                <label for="exampleInputPassword">Category</label>
                <select class="form-control" name="cat_id">
                    <?php
                    while ($raw = mysqli_fetch_assoc($cat_op)) {
                    ?>
                        <option value="<?php echo $raw['id']; ?>"><?php echo $raw['title']; ?></option>
                    <?php } ?>
                </select>
            </div>


            <div class="form-group">
                <label for="exampleInputName">Image</label>
                <input type="file" name="image">
            </div>



            <button type="submit" class="btn btn-primary">Submit</button>
        </form>



    </div>
</main>

<?php

require '../layouts/footer.php';
?>