<?php

$page_title = "Update User";
include_once "header.php";

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
 
include_once 'config/database.php';
include_once 'objects/user.php';
include_once 'monolog.php';

include_once 'objects/country.php';
 
$database = new Database();
$db = $database->getConnection();
 
$user = new User($db);
$country = new Country($db);
 
$user->id = $id;
 
$user->readOne();
 
?>
<?php 

if($_POST){
 
    $user->name = $_POST['name'];
    $user->email = $_POST['email'];
    $user->country_id = $_POST['country_id'];
 
    if($user->update()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "User was updated.";
        echo "</div>";
        $log->info("Update user", array('name' => $user->name, 'email' => $user->email));
    }
 
    else{
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Unable to update user.";
        echo "</div>";
        $log->error("Update user", array('name' => $user->name, 'email' => $user->email));
    }
}
?>
 
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' value='<?php echo $user->name; ?>' class='form-control' required/></td>
        </tr>
 
        <tr>
            <td>Email</td>
            <td><input type='emil' name='email' value='<?php echo $user->email; ?>' class='form-control' required/></td>
        </tr>
 
        <tr>
            <td>Category</td>
            <td>
            <?php
                $stmt = $country->read();
                
                echo "<select class='form-control' name='country_id'>";
                
                    echo "<option>Please select...</option>";
                    while ($row_country = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $country_id=$row_country['id'];
                        $country_name = $row_country['country'];
                
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
    echo "<a href='index.php' class='btn btn-default pull-right'>See all Users</a>";
echo "</div>";
 
include_once "footer.php";
?>