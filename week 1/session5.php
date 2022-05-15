<?php

    // $obj='{
    //     "name" : "basma",
    //     "email" : "basmafarouk05@gmail.com"
    // }';

    // $data= json_decode($obj,true);
    // var_dump($data);
    // // echo '<br>'.$data->email // if it is object
    // echo $data['email'];


    // $data=["name"=>"basma","age"=>20];
    // echo json_encode($data);


    $data= file_get_contents("https://tools.learningcontainer.com/sample-json-file.json");
    $dataArr=json_decode($data,true);
    print_r($dataArr)






?>