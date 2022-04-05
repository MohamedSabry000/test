<?php

$error = array();
// $fname = $lname = $address = $country = $gender = $username = $password = $confirm = $verify = $department = null;

$keys = array("fname","lname","address","country","gender","username","password","confirm","verify","department");
$data = array();

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{

    foreach($keys as $key)
    {
        if(isset($_POST[$key]))
        {
            
            $data[$key] = test_input($_POST[$key]);
            if(empty($data[$key]))
            {
                $error[$key] = "This field is required";
            }
        }
    }

    if($data['verify'] != $data['confirm'])
        $error['verify'] = "Caption does not match";

    unset($data['verify']);
    unset($data['confirm']);
    if(isset($_POST['skills']))
        $data["skills"] = $_POST['skills'];


    if(isset($_POST['key']))
        $key1 = $_POST['key'];

    if(count($error)>0){
        $err = json_encode($error);
        $data = json_encode($data);
        header("Location:index.php?error={$err}&data={$data}&key=$key1");
        exit();
    }

    // exit();
    
    if(count($data["skills"]) > 0)
        $data["skills"] = implode(',', $data["skills"]);

    // Create User
    try {
        $userfile = fopen("user.txt", "w");
        $user = implode(':', $data);



        fwrite($userfile, $user."\n");
        fclose($userfile);

        header("Location:showusers.php");
    } catch (Exception $ex) {
        var_dump($ex);
    }
}
?>
