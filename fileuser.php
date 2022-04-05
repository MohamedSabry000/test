<?php 
    $data=-1;
    if(isset($_GET["key"])){
        $data=$_GET["key"];
    }

    $filename = 'user.txt';
    $file = fopen($filename, 'r'); 

    if ($file) 
        $lines = explode("\n", fread($file, filesize($filename)));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 

        if (!empty($lines)) {
            foreach ($lines as $key => $line) {
                if($data != -1 && $line != "" && $key == $data) {
                    $user = explode(":", $line);
                    echo "<p>Name: ".$user[0]." ".$user[1]."</p>";
                    echo "<p>Address: ".$user[2]."</p>";
                    echo "<p>Country: ".$user[3]."</p>";
                    echo "<p>Gender: ".$user[4]."</p>";
                    echo "<p>User Name: ".$user[5]."</p>";
                //    echo "<p>User Name: ".$user[5]."</p>";
                    echo "<p>Skills: ".$user[5]."</p>";
                    
                    echo "</tr>";
                }
            }
        }


    ?>
</body>
</html>