<?php
/**
 * Created by PhpStorm.
 * User: Alessandro Arosio
 * Date: 28/03/2018
 * Time: 10:33
 */
session_start();
session_regenerate_id(true);
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



echo "<h2>View modules</h2>";

if ((isset($_SESSION['user']) or (isset($_SESSION['admin'])))) {
    $modules = array(
        "Introduction to Database Technology" => "dt.php",
        "Web programming using PHP" => "p1.php",
        "Problem Solving for Programming" => "pfp.php"
    );

    createDynNav($modules);
} else {
    accessDenied();
}
?>

</body>
</html>
