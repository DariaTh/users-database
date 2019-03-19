<?php

include_once 'config/database.php';
include_once 'objects/user.php';
include_once 'objects/country.php';
include_once 'monolog.php';
 

$database = new Database();
$db = $database->getConnection();
 

$user = new User($db);
$country = new Country($db);

$page_title = "Add User";
include_once "header.php";
 
echo "<div class='right-button'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>All Users</a>";
echo "</div>";
 
?>
<?php 

if($_POST){
 
    $user->name = $_POST['name'];
    $user->email = $_POST['email'];
    $user->country_id = $_POST['country_id'];
 
    if($user->create()){
        echo "<div class='alert alert-success'>User was added.</div>";
        $log->info("Add user", array('name' => $user->name, 'email' => $user->email));
    }
 
    else{
        echo "<div class='alert alert-danger'>Unable to add user.</div>";
        $log->error("Add user", array('name' => $user->name, 'email' => $user->email));
    }
}
?>
 
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
 
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' class='form-control' required /></td>
        </tr>
 
        <tr>
            <td>Email</td>
            <td><input type='email' name='email' class='form-control' required/></td>
        </tr>
 
        <tr>
            <td>Country</td>
            <td>
            <?php
           
            $stmt = $country->read();
            
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