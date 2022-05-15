<?php
// print("welcome to php course")."<br>";
// $name="basma";
// switch ($name) {
//     case ($name=='basma'):
//         # code...
//         echo "name equal ".$name;
//         break;
//         case ($name=='salma'):
//             # code...
//             echo "name equal".$name;
//             break;
    
//     default:
//         # code...
//         echo "name isn't found";
//         break;
// }
?>

<?php
function nextChar($char){
    $nextChar= ++$char;
    if(strlen($nextChar)>1){
        $nextChar= $nextChar[0];

    }
    return $nextChar;
}


echo nextChar('b');

///// another solution
$index = ord('c');
$nextchar= $index +1;
if($nextchar==123){
 $nextchar=97;
}
echo chr($nextchar);


//task2
$url = "http://godady.com/20558713";
$ArrVlaues = explode('/',$url);
echo "<br>".end($ArrVlaues);

//another solution
$index2=strrpos($url,'/');
echo "<br>".substr($url,$index2+1);




?>