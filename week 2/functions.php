<?php

    function Clean($input){
        $input=trim(strip_tags(stripslashes($input)));
       
        return $input;
    }

?>