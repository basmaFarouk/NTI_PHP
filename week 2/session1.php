<?php

    // include("functions.php");
    require("functions.php"); //== require"functions.php"


//////////////////////////////////
// date_default_timezone_set('africa/cairo');
//  echo date('Y-m-d')."<br>";
//  echo date("Y-m-d h:i:s a",1651174599)."<br>";
//  echo time()."<br>"; //1651174385

//  echo date_default_timezone_get()."<br>";

 ####################################################
function divide($pram1,$pram2){
    if($pram2==0){
        throw new Exception("param2 can't be zero");
    }
    return ($pram1/$pram2);
}

try{
    echo divide(1,0);
}catch(Exception $e){
    echo $e->getmessage(); //بجيب بيها المسدج اللي كتباها في الاكسبشن
    //او ممكن اكتب مسدج هنا بايدي
}finally{ //الكود اللي بكتبه جواها هيتنفذ سواء حصل اكسبشن او لا 
    echo "you are welcome";
}

?>