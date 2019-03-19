<?php

$page_title = "Read One User";
include_once "header.php";

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
 
include_once 'config/database.php';
include_once 'objects/user.php';
include_once 'objects/country.php';
 
$database = new Database();
$db = $database->getConnection();
 
$user = new User($db);
$country = new Country($db);
 
$user->id = $id;
 
$user->readOne();
 
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Read Users";
    echo "</a>";
echo "</div>";

echo "<table class='table table-hover table-responsive table-bordered'>";
 
    echo "<tr>";
        echo "<td>Name</td>";
        echo "<td>{$user->name}</td>";
    echo "</tr>";
 
    echo "<tr>";
        echo "<td>Email</td>";
        echo "<td>&#36;{$user->email}</td>";
    echo "</tr>";
 
    echo "<tr>";
        echo "<td>Country</td>";
        echo "<td>";
            
            $country->id=$user->country_id;
            $country->readName();
            echo $country->name;
        echo "</td>";
    echo "</tr>";
 
echo "</table>";
 
include_once "footer.php";
?>