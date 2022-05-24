<?php

require 'dbclass.php';
require 'validator.php';
require 'uploader.php';

class user{
    private $name;
    private $email;
    private $password;
    private $image;

    /** Register Method
     * input >>> Array contains inputs from user..
     * output >>> Final Result
     */

     public function Register($input,$file){

        //Create OBJ from Validator class
        $validator = new validator;
        $this->name = $validator->Clean($input['name']);
        $this->email = $validator->Clean($input['email']);
        $this->password = $validator->Clean($input['password']);
        

        //Validate Inputs
        $errors=[];
        $result = null;

        //Validate Name
        if(!$validator->validate($this->name,'required')){
            $errors['Name '] = "Required";
        }

         //Validate Email
        if(!$validator->validate($this->email,'required')){
            $errors['Email '] = "Required";
        }elseif(!$validator->validate($this->email,'email')){
            $errors['Inavlid ']= "Email Format";
        }

        //Validate Password
        if (!$validator->validate($this->password, 'required')) {
            $errors['Password '] = "Required";
        } elseif (!$validator->validate($this->password,'min',5)) {
            $errors['Password '] = "Length should be 5 or more";
        }

        //Validate Image
        if(!$validator->validate($file['image']['name'],'required')){
            $errors['Image '] = "Required";
        }elseif(!$validator->validate($file,'image')){
            $errors['Image '] = "Invalid Extension";
        }

        if(count($errors)>0){
            $result=$errors;
        }else{
            $this->password=md5($this->password);
            $img= new Upload;
            $this->image=$img->UploadFile($file);
            $sql = "insert into user (name,email,password,image) values ('$this->name','$this->email','$this->password','$this->image')";

            //DB Object
            $dbobj = new DB;
            $op = $dbobj->doQuery($sql);
            if($op){
                $result = ["Raw "=>"Inserted"];
            }else{
                $result = ["Raw "=>"Not Inserted"];
            }

        }

        return $result;
     } 

     //Diplay Users
     public function listUsers(){

        $dbobj = new DB;
        $sql = "select * from user";

        //DB Object
        
        $op = $dbobj->doQuery($sql);

        return $op;
     }


     public function getData($id){
         $dbobj = new DB;
         $sql = "select * from user where id = $id";
         $op= $dbobj->doQuery($sql);
         $data = mysqli_fetch_assoc($op);

         return $data;

     }

     public function update($input,$files,$id){
        $validator = new validator;
        $this->name = $validator->Clean($input['name']);
        $this->email = $validator->Clean($input['email']);
        $errors =[];
        $result =null;

        if(!$validator->validate($this->name,'required')){
            $errors["name"]=' Required';

        }

        //Validate Email
        if (!$validator->validate($this->email, 'required')) {
            $errors['Email '] = "Required";
        } elseif (!$validator->validate($this->email, 'email')) {
            $errors['Inavlid '] = "Email Format";
        }

        //Validate image
        if ($validator->validate($files['image']['name'], 'required')) {
            if (!$validator->validate($files, 'image')) {
                $errors['Image '] = "Invalid Extension";
            }
        }

        if(count($errors)>0){
            $result =$errors;
        }else{
            $user = new user;
            $data = $user->getData($id);
            if($validator->validate($files['image']['name'],'required')){
                $typesInfo = explode('/',$files['image']['type']);
                $extension = strtolower(end($typesInfo));

                $this->image = uniqid().'.'.$extension;
                $tmpPath = $files['image']['tmp_name'];
                $disPath = '../uploads/'.$this->image;

                if(move_uploaded_file($tmpPath, $disPath)){
                    unlink('../uploads/'.$data['image']);
                }
            }else{
                $this->image = $data['image'];
            }
            $db = new DB;
            $sql = "update user set name = '$this->name', email ='$this->email', image= '$this->image' where id = $id";
            $op= $db->doQuery($sql);
            if($op){
                $result = ["Raw "=>"Updated"];
            }else{
                $result = ["Raw "=>" not Updated"];
            }


        }

    
        return $result;

     }
}
 


?>