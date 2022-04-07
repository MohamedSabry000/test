<?php
    session_start();
    if(isset($_SESSION["id"])){
        header("Location:showusers.php");
        exit();
    }
    if(isset($_POST['sub'])){
        
        $u = $_POST['username'];
        $p = $_POST['password'];
        // echo "<pre></pre>";
        // echo $u."<br>";
        // echo $p."<br>";
        // echo "<pre></pre>";
        // echo $u;
        // echo $p;

         // Open the file
        // $filename = 'user.txt';
        // $file = fopen($filename, 'r'); 

        // // Add each line to an array
        // if ($file) 
        //     $array = explode("\n", fread($file, filesize($filename)));

        // // echo "hello";

        require "pdo/crud.php";

        if(isset($u) && isset($p)){
            $id = check_user_exist($u, $p);
            if($id){
                
                session_start();
                $_SESSION['id']=$id;
                // echo $_SESSION['id'];
                    // exit();
                header("Location:showusers.php");
                exit();
            }else{
                echo 'username or password does not exist';
            }
        }

        // if (!empty($array)) {
        //     // echo "hello";
        //     foreach ($array as $key => $line) {
        //         // echo "hello";
        //         if($line != "") {
        //             // echo "hello";
        //             $data = explode(":", $line);
        //             // var_dump($data);
        //             if($data[5] == $u && $data[6] == $p){
        //                 echo "5";
        //                 session_start();
        //                 $_SESSION['id']=$key;
        //                 echo $_SESSION['id'];
        //                 // exit();
        //                 header("Location:showusers.php");
        //                 // $localkey = $key;
        //                 break;
        //             }
        //         }
        //     }
        // } else{
        //     echo 'username or password does not exist';
        // }


    }



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
    <form action="login.php" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        
    <table>
        <colgroup>
            <col style="width: 150px" />
        </colgroup>
        <tfoot>
            <tr>
                <td class="bottom" colspan="4">
                    <input type="submit" name="sub" value="Submit" />
                    <input type="reset" value="Reset" />
                </td>
            </tr>
        </tfoot>
        <tbody>
            <tr>
                <td>
                    User Name
                    <input type="text" name="username" placeholder="Username">
                </td>
            </tr>
            <tr>
                <td>
                    Password Name
                    <input type="password" name="password" placeholder="Password">
                </td>
            </tr>
</body>
</html>