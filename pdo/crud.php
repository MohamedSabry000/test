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

function delete_user($id)
{
    try{
        $db=connectToDatabase();
        // var_dump($db);
        if($db){
            $delete_query = 'delete from users where `id` =:id';
            $del_stmt = $db->prepare($delete_query);
            $del_stmt->bindParam(":id",$id );
            $res=$del_stmt->execute();
            if ($res){
                header("Location:../showusers.php");
            }
    
        }
    
    }catch (PDOException $e){
        echo $e->getMessage();
    }
}

function get_all_users()
{
    try{
        $db=connectToDatabase();
        if($db){
            $select_query = 'select * from users';
            $select_stmt = $db->prepare($select_query);
            $res=$select_stmt->execute();
            if ($res){
                $users = $select_stmt->fetchAll(PDO::FETCH_OBJ);
                return $users;
            }
        }
    return null;
    }catch (PDOException $e){
        echo $e->getMessage();
    }
}

function get_one_user($id)
{
    try{
        $db=connectToDatabase();
        if($db){
            $select_query = 'select * from users where id=:id';
            $select_stmt = $db->prepare($select_query);
            $select_stmt->bindParam(":id",$id );

            $res=$select_stmt->execute();
            if ($res){
                $users = $select_stmt->fetchAll(PDO::FETCH_OBJ);
                return $users;
            }
        }
    return null;
    }catch (PDOException $e){
        echo $e->getMessage();
    }
}

function add_user($data, $img = "")
{
    try{
        $db=connectToDatabase();
        if($db){
            if(isset($img)){
                $insert_query = 'insert into users (`fname`,`lname`,`address`,`country`,`gender`,`username`,`password`,`department`,`skills`,`image`) values (:fname,:lname,:address,:country,:gender,:username,:password,:department,:skills,"'.$img.'")';
            } else {
                $insert_query = 'insert into users (fname,lname,address,country,gender,username,password,department,skills) 
                            values (:fname,:lname,:address,:country,:gender,:username,:password,:department,:skills)';
            }
            echo "<pre>";
            print_r($data);
            echo "</pre>";
            // exi  t();
            $select_stmt = $db->prepare($insert_query);

            $select_stmt->bindParam(":fname",$data['fname'] );
            $select_stmt->bindParam(":lname",$data['lname'] );
            $select_stmt->bindParam(":address",$data['address'] );
            $select_stmt->bindParam(":country",$data['country'] );
            $select_stmt->bindParam(":gender",$data['gender'] );
            $select_stmt->bindParam(":username",$data['username'] );
            $select_stmt->bindParam(":password",$data['password'] );
            $select_stmt->bindParam(":department",$data['department'] );
            $select_stmt->bindParam(":skills",$data['skills'] );


            $res=$select_stmt->execute();
            if ($res){
                return true;
            }
        }
    return false;
    }catch (PDOException $e){
        echo $e->getMessage();
    }
}


function update_user($id, $data, $img = "")
{
    try{
        $db=connectToDatabase();
        if($db){
            if(isset($img) && $img != ""){
                $update_query = 'update users set `fname`=?,`lname`=?,`address`=?,`country`=?,`gender`=?,`username`=?,`password`=?,`department`=?,`skills`=?,`image`="'.$img.'" where `id`='.$id;
            } else {
                $update_query = 'update users set `fname`=:fname,`lname`=:lname,`address`=:address,`country`=:country,`gender`=:gender,`username`=:user,`password`=:password,`department`=:department,`skills`=:skills where `id`='.$id;
            }
            echo "<pre>";
            print_r($data);
            echo "</pre>";
            // exi  t();
            echo $update_query;
            $update_stmt = $db->prepare($update_query);

            $update_stmt->bindParam(1,$data['fname'], PDO::PARAM_STR );
            $update_stmt->bindParam(2,$data['lname'], PDO::PARAM_STR ); 
            $update_stmt->bindParam(3,$data['address'], PDO::PARAM_STR ); 
            $update_stmt->bindParam(4,$data['country'], PDO::PARAM_STR ); 
            $update_stmt->bindParam(5,$data['gender'], PDO::PARAM_STR ); 
            $update_stmt->bindParam(6,$data['username'], PDO::PARAM_STR ); 
            $update_stmt->bindParam(7,$data['password'], PDO::PARAM_STR ); 
            $update_stmt->bindParam(8,$data['department'], PDO::PARAM_STR ); 
            $update_stmt->bindParam(9,$data['skills'], PDO::PARAM_STR ); 

            $res=$update_stmt->execute();
            if ($res){
                return true;
            }
        }
    return false;
    }catch (PDOException $e){
        echo $e->getMessage();
    }
}

