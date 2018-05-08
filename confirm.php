<?php
/**
 * Created by PhpStorm.
 * User: Alessandro Arosio
 * Date: 25/03/2018
 * Time: 10:11
 */
session_start();
session_regenerate_id(true);
require_once "include/functions.php";
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<?php
include "include/head.php";
?>
<body>
<?php
include "include/header.php";
include "include/dcs-nav.php";
?>

<h2>New user registration</h2>

<?php
if ((isset($_SESSION['user']) or (isset($_SESSION['admin'])))) {
    $self = htmlentities($_SERVER["PHP_SELF"]);

    $clean = array();
    $errors = array();

    $formSubmitted = false;
    $errorsDetected = false;


    if (isset($_POST["confirm"])) {
        $formSubmitted = true;
        if (registerUser()) {
            echo "<p><b>New user successfully created.</b></p>";
            echo "<p><b>Please wait... we are processing the changes. You will be redirected to the admin home page shortly</b></p>";
        } else {
            echo "<p style='color: red'>Some errors were found, please go back and retry</p>";
        }
        header("refresh:10; url=add-user.php");
    }

    if (isset($_POST["goback"])) {
        $formSubmitted = true;
        header("Location: add-user.php");
    }
    echo '
<p>Please review the details and confirm</p>

<form action="' . $self . '" method="post">
    <fieldset>
        <div>
            <label for="title">Title: </label>
            <input name="title" id="title" disabled="disabled" value="' . $_SESSION["title"] . '" >
        </div>
        <div>
            <label for="firstname">First name: </label>
            <input name="fistname" id="firstname" disabled="disabled" value="' . $_SESSION["firstname"] . '">
        </div>
        <div>
            <label for="lastname">Last name: </label>
            <input name="lastname" id="lastname" disabled="disabled" value="' . $_SESSION["lastname"] . '">
        </div>
        <div>
            <label for="email">Email address: </label>
            <input name="email" id="email" disabled="disabled" value="' . $_SESSION["email"] . '">
        </div>
        <div>
            <label for="username">Username: </label>
            <input name="username" id="username" disabled="disabled" value="' . $_SESSION["username"] . '">
        </div>
        <div>
            <label for="password">Password: </label>
            <input name="password" id="password" disabled="disabled" value="' . $_SESSION["password"] . '">
        </div>
        <div>
            <input type="submit" name="confirm" value="Confirm">
            <input type="submit" name="goback" value="Go back">
        </div>
    </fieldset>
</form>';
} else {
    accessDenied();
}
?>
</body>
</html>

