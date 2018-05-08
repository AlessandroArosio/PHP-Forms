<?php
/**
 * Created by PhpStorm.
 * User: Alessandro Arosio
 * Date: 25/03/2018
 * Time: 18:26
 */
session_start();
include_once "include/functions.php";
logout();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<body>
<h1>Log out</h1>

<?php

header("refresh:5; url=index.php");
echo "<p>You will be redirected shortly to the home page</p>";
?>

</body>
</html>
