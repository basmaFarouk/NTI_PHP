<?php
if($_SESSION['user']['role_id']!=1){
    header("location: ".url(''));
}

?>