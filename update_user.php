<?php

// set page header
$page_title = "Update User";
include_once "header.php";

// get ID of the product to be edited
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
 
// set ID property of product to be edited
$user->id = $id;
 
// read the details of product to be edited
$user->readOne();
 
?>
<?php 
// if the form was submitted
if($_POST){
 
    // set product property values
    $user->name = $_POST['name'];
    $user->email = $_POST['email'];
    $user->country_id = $_POST['country_id'];
 
    // update the product
    if($user->update()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "User was updated.";
        echo "</div>";
    }
 
    // if unable to update the product, tell the user
    else{
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Unable to update user.";
        echo "</div>";
    }
}
?>
 
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' value='<?php echo $user->name; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Email</td>
            <td><input type='emil' name='email' value='<?php echo $user->email; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Category</td>
            <td>
            <?php
                $stmt = $country->read();
                
                // put them in a select drop-down
                echo "<select class='form-control' name='country_id'>";
                
                    echo "<option>Please select...</option>";
                    while ($row_country = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $country_id=$row_country['id'];
                        $country_name = $row_country['country'];
                
                        // current category of the product must be selected
                        if($user->country_id==$country_id){
                            echo "<option value='$country_id' selected>";
                        }else{
                            echo "<option value='$country_id'>";
                        }
                
                        echo "$country_name</option>";
                    }
                echo "</select>";
                ?>
            </td>
        </tr>
 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Update</button>
            </td>
        </tr>
 
    </table>
</form>
<?php
 


echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>Read about Users</a>";
echo "</div>";
 
// set page footer
include_once "footer.php";
?>