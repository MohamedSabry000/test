<?php

require "pdoconnect.php";

$db=connectToDatabase();
try {

    var_dump($db);
    $statement = $db->prepare("UPDATE student
        SET name = :student_name WHERE id=:student_id ");
    $db->beginTransaction();
    $statement->execute([":student_name"=>'OS', ":student_id"=>'9']);
    $statement->execute(["student_name"=>'Application', "student_id"=>'12']);
    $db->commit();

    header("Location:db_connect.php");
}
catch (PDOException $e) {
    if ($db->inTransaction()) {
        $db->rollback();
    }
    throw $e;
}
