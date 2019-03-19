<?php

$page_title = "Read One User";
include_once "header.php";

// get ID of the product to be read
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/user.php';
include_once 'objects/country.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare objects
$user = new User($db);
$country = new Country($db);
 
// set ID property of product to be read
$user->id = $id;
 
// read the details of product to be read
$user->readOne();
 
// read products button
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Read Users";
    echo "</a>";
echo "</div>";


// HTML table for displaying a product details
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
            // display category name
            $country->id=$user->country_id;
            $country->readName();
            echo $country->name;
        echo "</td>";
    echo "</tr>";
 
echo "</table>";
 
// set footer
include_once "footer.php";
?>