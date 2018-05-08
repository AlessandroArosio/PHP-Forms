<?php
/**
 * Created by PhpStorm.
 * User: Alessandro Arosio
 * Date: 29/03/2018
 * Time: 14:06
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
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 50%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 5px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>
<?php
include "include/header.php";
include "include/dcs-nav.php";

if ((isset($_SESSION['user']) or (isset($_SESSION['admin'])))) {

    $file = "../../private/accounts.txt";
    $usersArray = array();
    $fileToArray = array();

    if (is_file($file) and is_readable($file)) {
        $handle = fopen($file, "r");
        while (!feof($handle)){
            $fileToArray[] = fgets($handle);
        }
        fclose($handle);

        echo "<h2>List of users in the database</h2>";
        echo "<table>
        <tr>
            <th>Title</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Email</th>
            <th>Username</th>
            <th>Password</th>
        </tr>";

        foreach ($fileToArray as $line){
            $usersArray = explode(",",$line);
            echo "<tr>";
            foreach ($usersArray as $user){
                echo '<td>'.$user.'</td>';
            }
            echo "</tr>";
        }

    }
} else {
    accessDenied();
}
?>

</body>
</html>