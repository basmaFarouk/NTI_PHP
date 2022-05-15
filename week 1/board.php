<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Board</title>
</head>
<body>
    <table width="300px">
        <?php
        for ($row=1; $row <9 ; $row++) { 
            # code...
            echo "<tr>";
            for ($column=1; $column <9 ; $column++) { 
                # code...
               if(($row +$column)%2 ==0){
                   echo '<td bgcolor="white" width ="50px" height="50px" ></td>';
               }else{
                echo '<td bgcolor="black" width ="50px" height="50px" ></td>';
               }
                

            }


            echo "</tr>";
        }



        ?>

    </table>
</body>
</html>