<?php

$dns = 'mysql:dbname=test1;host=localhost;port=3306';
$user = 'root';
$password = '';

try{
    $pdo = new PDO($dns, $user, $password);
    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "Connected successfully";
    $select_query = "SELECT * FROM users";
    $select_stmt = $pdo->prepare($select_query);
    $res = $select_stmt->execute();

    if($res){
        $users = $select_stmt->fetchAll(PDO::FETCH_OBJ);
        var_dump($users);
        // echo "<pre>";
        // print_r($students);
        // echo "</pre>";
        foreach($users as $user){
            echo $user->fname."<br>";
            echo $user->lname."<br>";
            echo $user->address."<br>";
            echo $user->country."<br>";
            echo $user->image."<br>";
            echo "<hr>";
        }
    }


    ################# insert ######################
    // $insert_query = "INSERT INTO students (name, email, phone, skills, image) VALUES (?,?,?,?,?)";
    


    // $insert_stmt = $pdo->prepare($insert_query);
    // $insert_stmt->bindParam(1, $name);
    // $insert_stmt->bindParam(2, $email);
    // $insert_stmt->bindParam(3, $phone);
    // $insert_stmt->bindParam(4, $skills);
    // $insert_stmt->bindParam(5, $image);

    // $name = "Ahmed";
    // $email = "";
    // $phone = "";
    // $skills = "";
    // $image = "";

    // $res = $insert_stmt->execute();
    // if($res){
    //     echo "Inserted successfully";
    // }

    



}catch(Exception $ex){
    var_dump($ex);
}