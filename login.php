<?php
/**
 * Created by PhpStorm.
 * User: aless
 * Date: 27/03/2018
 * Time: 21:00
 */
session_start();
session_regenerate_id(true);
require_once 'include/functions.php';
if ((isset($_SESSION['user']) or (isset($_SESSION['admin'])))) {
    logOut();
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<?php
require_once "include/functions.php";
include "include/head.php";
?>
<body>
<?php
include "include/header.php";
include "include/dcs-nav.php";
?>

<h2>Staff intranet</h2>

<p>Please insert user name and password</p>
<?php
$self = htmlentities($_SERVER["PHP_SELF"]);

$clean = array();
$errors = array();

$formSubmitted = false;
$errorDetected = false;

if (isset($_POST["submit"])){
    $formSubmitted = true;
    if (isset($_POST["login"])){
        $trim = trim($_POST["login"]);
        $length = strlen($trim);
        if ($length > 0){
            $clean["login"] = htmlentities($trim);
        } else {
            $errorDetected = true;
            $errors["login"] = "Username is required";
        }
    } else {
        $errors[] = "Login name is incorrect";
        $errorDetected = true;
    }

    if (isset($_POST["password"])){
        $trim = trim($_POST["password"]);
        if (strlen($trim) > 0) {
            $clean["password"] = htmlentities($trim);
        } else {
            $errors["password"] = "Password is required";
            $errorDetected = true;
        }
    } else {
        $errors[] = "Password is required";
        $errorDetected = true;
    }
    if (isset($clean["login"]) and isset($clean["password"])) {
        if (!checkCredentials($clean["login"], $clean["password"])){
            $errorDetected = true;
            $errors[] = "Credentials invalid or user not found";
        }
    }
}

if ($errorDetected === false and $formSubmitted === true){
    if ($clean["login"] == "admin") {
        $_SESSION["admin"] = $clean["login"];
        header("Location: intranet.php");
    } else {
        $_SESSION["user"] = $clean["login"];
        header("Location: intranet.php");
    }
}


?>

<form action="<?php echo $self; ?>" method="post">
    <fieldset>
        <div>
            <label for="login">Username: </label>
            <input type="text" name="login" id="login">
            <?php
            if (isset($errors["login"])){
                echo "<span style='color: red'>Username cannot be blank!</span>";
            }
            ?>
        </div>
        <div>
            <label for="password">Password: </label>
            <input type="password" name="password" id="password">
            <?php
            if (isset($errors["password"])){
                echo "<span style='color: red'>Password cannot be blank!</span>";
            }
            ?>
        </div>
        <div>
            <input type="submit" name="submit" value="Log-in">
        </div>
    </fieldset>
</form>
</body>
</html>
