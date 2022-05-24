<?php

require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checklogin.php';

##############################################################################
////Logic
$sql="select * from roles";
$op=doQuery($sql);

###############################################################################

require '../layouts/headers.php';
require '../layouts/nav.php';
require '../layouts/sideNav.php';

?>



<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">

        <?php
        //Print Messages....
            Messages("Dashboard / Roles / display");
        
        ?>
        </ol>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Roles Data
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            <th>ID</th>
                                <th>Title</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>

                        <?php 
                        $i=0;
                        while($raw=mysqli_fetch_assoc($op)){
                            
                            ?>
                            <tr>
                                <td><?php echo ++$i;?></td>
                                <td><?php echo $raw['title'];?></td>
                                <td>
                                <a href='edit.php?id=<?php echo $raw['id'];?>' class="btn btn-primary">Edit</a>
                                <a href='delete.php?id=<?php echo $raw['id'];?>' class="btn btn-danger">Delete</a>
                                </td>

                            </tr>
                          <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>


<?php require '../layouts/footer.php';?>