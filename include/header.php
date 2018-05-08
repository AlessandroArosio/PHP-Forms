<?php
/*
 * Created by PhpStorm.
 * User: Alessandro Arosio
 * Date: 20/03/2018
 * Time: 17:35
 */

$logoutHeader=array();
if (isset($_SESSION["admin"])) {
    echo '<p>Logged in as ' . '<a href="intranet.php">'.$_SESSION["admin"].'</a>' . '</p>';
}
if (isset($_SESSION["user"])){
    echo '<p>Logged in as ' . '<a href="intranet.php">'.$_SESSION["user"].'</a>' . '</p>';
}
if (!isset($_SESSION["admin"]) and !isset($_SESSION["user"])){
    echo "<p>Logged in as guest</p>";
}








// Array containing a dynamic navigation bar on the top (header indeed)
if (isset($_SESSION["admin"])){
    $logoutHeader = array(
        "Add user" => "add-user.php",
        "View users" => "users-list.php",
        "Modules" => "intranet.php",
        "Logout" => "logout.php"
    );
}
if (isset($_SESSION["user"])) {
    $logoutHeader = array(
        "Modules" => "intranet.php",
        "Logout" => "logout.php",
    );
}
if (!isset($_SESSION["admin"]) and !isset($_SESSION["user"])) {
    $logoutHeader = array(
        "Login" => "login.php"
    );
}
    createDynNav($logoutHeader);
