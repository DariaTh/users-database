<?php

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$records_per_page = 5;

$from_record_num = ($records_per_page * $page) - $records_per_page;

include_once 'config/database.php';
include_once 'objects/user.php';
include_once 'objects/country.php';
include_once 'monolog.php';
 
$database = new Database();
$db = $database->getConnection();
 
$user = new User($db);
$country = new Country($db);

$stmt = $user->readAll($from_record_num, $records_per_page);
$num = $stmt->rowCount();

$page_title = "Read Users";
include_once "header.php";
 
echo "<div class='right-button'>";
    echo "<a href='create_user.php' class='btn btn-default pull-right'>Create User</a>";
echo "</div>";

if($num>0){
 
    echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
            echo "<th>User</th>";
            echo "<th>Email</th>";
            echo "<th>Country</th>";
            echo "<th>Actions</th>";
        echo "</tr>";
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
 
            echo "<tr>";
                echo "<td>{$name}</td>";
                echo "<td>{$email}</td>";
                echo "<td>";
                    $country->id = $country_id;
                    $country->readName();
                    echo $country->name;
                echo "</td>";
 
                echo "<td>";
                  
                    echo "<a href='read_one.php?id={$id}' class='btn btn-primary left-margin'>
                    <span class='glyphicon glyphicon-list'></span> Read
                    </a>

                    <a href='update_user.php?id={$id}' class='btn btn-info left-margin'>
                    <span class='glyphicon glyphicon-edit'></span> Edit
                    </a>

                    <a delete-id='{$id}' class='btn btn-danger delete-object'>
                    <span class='glyphicon glyphicon-remove'></span> Delete
                    </a>";
                echo "</td>";
 
            echo "</tr>";
 
        }
 
    echo "</table>";
 
}
 
else{
    echo "<div class='alert alert-info'>No users found.</div>";
}

$page_url = "index.php?";
 
$total_rows = $user->countAll();
 
include_once 'paging.php';
 
include_once "footer.php";
?>