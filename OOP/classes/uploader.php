<?php

class Upload{
    public function UploadFile($input){
        $image = null;
        $imgType= $input['image']['type'];
        $imgArray = explode('/',$imgType);
        $imgExtension = strtolower(end($imgArray));
        $FinalName = uniqid().'.'.$imgExtension;
        $tmpName= $input['image']['tmp_name'];
        $disPath = '../uploads/'.$FinalName;
        if(move_uploaded_file($tmpName,$disPath)){
            $image = $FinalName;
        }

        return $image;
    }
}

?>