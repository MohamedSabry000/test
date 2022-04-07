<?php
    session_start();
    if(isset($_SESSION["id"])){
        header("Location:showusers.php");
        exit();
    }
    if(isset($_POST['sub'])){
        
        $u = $_POST['username'];
        $p = $_POST['password'];

        require "pdo/crud.php";

        if(isset($u) && isset($p)){
            $user = check_user_exist($u, $p);
            if($user){
                
                session_start();
                $_SESSION['id']=$user->id;

                header("Location:showusers.php");
                exit();
            }else{
                echo 'username or password does not exist';
            }
        }
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