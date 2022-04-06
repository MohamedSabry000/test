<?php




function connectToDatabase()
{
    $dns = 'mysql:dbname=test1;host=localhost;port=3306';
    $user = 'root';
    $password = '';
    
    try{
        return new PDO($dns, $user, $password);
    
        // echo "Connected successfully";
    }catch(Exception $ex){
        var_dump($ex);
        exit();
    }
}

