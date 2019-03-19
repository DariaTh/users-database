<?php
// include database and object files
include_once 'config/database.php';
include_once 'objects/user.php';
include_once 'objects/country.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// pass connection to objects
$user = new User($db);
$country = new Country($db);

$page_title = "Add User";
include_once "header.php";
 
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>Read about user</a>";
echo "</div>";
 
?>
<?php 
// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){
 
    // set product property values
    $user->name = $_POST['name'];
    $user->email = $_POST['email'];
    $user->country_id = $_POST['country_id'];
 
    // create the product
    if($user->create()){
        echo "<div class='alert alert-success'>User was added.</div>";
    }
 
    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to add user.</div>";
    }
}
?>
 
<!-- HTML form for creating a product -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
 
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Email</td>
            <td><input type='email' name='email' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Country</td>
            <td>
            <?php
            // read the product categories from the database
            $stmt = $country->read();
            
            // put them in a select drop-down
            echo "<select class='form-control' name='country_id'>";
                echo "<option>Select country...</option>";
            
                while ($row_country = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row_country);
                    echo "<option value='{$id}'>{$country}</option>";
                }
            
            echo "</select>";
            ?>
            </td>
        </tr>
 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Create</button>
            </td>
        </tr>
 
    </table>
</form>
<?php
 

include_once "footer.php";
?>