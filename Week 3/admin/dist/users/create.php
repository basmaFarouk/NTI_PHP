<?php
########################################################################################################
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checklogin.php';
// echo $_SERVER['PHP_SELF']."<br>";
// echo $_SERVER['SCRIPT_NAME']."<br>";
// echo $_SERVER['SERVER_NAME']."<br>";
// ECHO $_SERVER['REMOTE_HOST']."<BR>";
// exit;


########################################################################################################
# Fetch Roles ..... 
$sql = "select * from roles";
$roles_op = doQuery($sql);
########################################################################################################


// LOGIC .... 

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    # FETCH && CLEAN DATA .... 
    $name     = Clean($_POST['name']);
    $email    = Clean($_POST['email']);
    $password = Clean($_POST['password']);
    $role_id  = Clean($_POST['role_id']);
    $phone    = Clean($_POST['phone']);





    # Error [] 
    $errors = [];

    # Validate name ....  
    if (!validate($name, 'required')) {
        $errors['Name'] = "Field Required";
    } elseif (!validate($name, 'min', 3)) {
        $errors['Name'] = "Field Length must be >= 2 chars";
    }

    # Validate Password 
    if (!validate($password, 'required')) {
        $errors['Password'] = "Field Required";
    } elseif (!validate($password, 'min')) {
        $errors['Password'] = "Field Length must be >= 6 chars";
    }


    # Validate Email 
    if (!validate($email, 'required')) {
        $errors['Email'] = "Field Required";
    } elseif (!validate($email, 'email')) {
        $errors['Email'] = "Invalid Format";
    }

    # Validate role_id 
    if (!validate($role_id, 'required')) {
        $errors['Role'] = "Field Required";
    } elseif (!validate($role_id, 'int')) {
        $errors['Role'] = "Invalid Id";
    }


    # Validate phone 
    if (!validate($phone, 'required')) {
        $errors['phone'] = "Field Required";
    } elseif (!validate($phone, 'phone')) {
        $errors['phone'] = "InValid Format";
    }



    // # Validate image 
    // if (!validate($_FILES['image']['name'], 'required')) {
    //     $errors['Image'] = "Field Required";
    // } elseif (!validate($_FILES, 'image')) {
    //     $errors['Image'] = "Invalid Format";
    // }


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

            $password = md5($password);

            $sql = "insert into users (name,email,password,role_id,phone,image) values ('$name','$email','$password',$role_id,'$phone','$FinalName')";
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
            Messages('Dashboard / Users / Create');
            ?>


        </ol>


        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">Name</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="name" placeholder="Enter Name">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Email address</label>
                <input type="email" class="form-control" required id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Enter email">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">New Password</label>
                <input type="password" class="form-control" required id="exampleInputPassword1" name="password" placeholder="Password">
            </div>



            <div class="form-group">
                <label for="exampleInputEmail">Phone</label>
                <input type="text" class="form-control" required id="exampleInputEmail1" aria-describedby="emailHelp" name="phone" placeholder="Enter phone">
            </div>


            <div class="form-group">
                <label for="exampleInputPassword">Role</label>
                <select class="form-control" name="role_id">
                    <?php
                    while ($raw = mysqli_fetch_assoc($roles_op)) {
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