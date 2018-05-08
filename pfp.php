<?php
/**
 * Created by PhpStorm.
 * User: aless
 * Date: 28/03/2018
 * Time: 20:33
 */
session_start();
session_regenerate_id(true);
require_once 'include/functions.php';
//if ((!isset($_SESSION['user']) or (!isset($_SESSION['admin'])))) {

//}
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
    echo "<h2>Results page of Problem solving for Programming</h2>";
    $modules = array(
        "Introduction to Database Technology" => "dt.php",
        "Web programming using PHP" => "p1.php",
        "Problem Solving for Programming" => "pfp.php"
    );

    createDynNav($modules);

    echo "
<table>
		  <tr>
			<th>Year</th>
			<th>Students</th>
			<th>Pass</th>
			<th>Fail (no resit)</th>
			<th>Resit</th>
			<th>Withdrawn</th>
		  </tr>
		  <tr>
			<td>2012/13</td>
			<td>65</td>
			<td>45</td>
			<td>7</td>
			<td>3</td>
			<td>10</td>
		  </tr>
		  <tr>
			<td>2013/14</td>
			<td>55</td>
			<td>35</td>
			<td>5</td>
			<td>15</td>
			<td>0</td>
		  </tr>
		  <tr>
			<td>2014/15</td>
			<td>60</td>
			<td>45</td>
			<td>2</td>
			<td>10</td>
			<td>3</td>
		  </tr>
		  <tr>
			<td>2015/16</td>
			<td>38</td>
			<td>30</td>
			<td>8</td>
			<td>3</td>
			<td>7</td>
		  </tr>
		</table>";
} else {
    accessDenied();
}
?>
</body>
</html>

