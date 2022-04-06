<?php

require "pdoconnect.php";

$user_id = $_GET["id"];
try{

    $db=connectToDatabase();
    var_dump($db);
    if($db){
        $delete_query = 'delete from student where `id` =:stdid';
        $del_stmt = $db->prepare($delete_query);
        $del_stmt->bindParam(":stdid",$user_id );
        $res=$del_stmt->execute();
        if ($res){
            header("Location:db_connect.php");
        }

    }

}catch (PDOException $e){
    echo $e->getMessage();
}
