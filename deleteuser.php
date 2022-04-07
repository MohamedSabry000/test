<?php 

session_start();
    if(!isset($_SESSION["id"])){
        header("Location: login.php");
        exit();
    }

    $data=-1;
    if(isset($_GET["key"])){
        $data=$_GET["key"];
    }

    $filename = 'user.txt';
    $file = fopen($filename, 'r'); 

    if ($file) 
        $lines = explode("\n", fread($file, filesize($filename)));
	
	if($data !== -1){
        require "pdo/crud.php";
		delete_user($data);
	
        header("Location:showusers.php");
    }
	
?>


<!-- https://us05web.zoom.us/j/87585406780?pwd=SGMxczVHaEl6alhFVDF3dk53R05NUT09 -->