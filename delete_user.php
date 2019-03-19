<?php

if($_POST){
 
    include_once 'config/database.php';
    include_once 'objects/user.php';
    include_once 'monolog.php';
 
    $database = new Database();
    $db = $database->getConnection();
 
    $user = new User($db);
     
    $user->id = $_POST['object_id'];
     
    if($user->delete()){
        echo "User was deleted.";
        $log->info("Delete user", array('user' => $user->id));
    }
     
    else{
        echo "Unable to delete user.";
        $log->error("Delete user", array('user' => $user->id));
    }
}
?>