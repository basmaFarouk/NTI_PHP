<?php

class user{
    private $email;

    private function __construct(){

    }
    function sendEmail($text){
        echo "hello".$text;
    }
}

class student extends user{

}

$user =new user;
echo $user;

?>