<?php
/*
 * Created by PhpStorm.
 * User: Alessandro Arosio
 * Date: 20/03/2018
 * Time: 16:48
 */

/*
 * Function to create dynamically a navigation menu. It takes as parameter an array of string and print them out.
 * @param $links: Array of strings containing element to be printed out with links to the pages
 * @param string $ID
 */
function createDynNav($links, $ID="headerNav"){
    $output = '<nav id='.$ID.'>'.PHP_EOL.'<ul>'.PHP_EOL;
    foreach ($links as $navElement => $link) {
        $output .= " <li><a href=$link>$navElement</a></li> ";
    }
    $output .= " </ul></nav> ";

    echo $output;
}

/* This function shows some DCS links in the header and the logo of my university. */
function showDCS($linkArray, $ID)
{
    echo "  <div>" . PHP_EOL . "
                       <img id='bbkLogo' src='images/bbk-logo.jpg' alt='Birkbeck logo'>" . PHP_EOL .
        "<h1>Department of Computer Science - Birkbeck University of London</h1>" . PHP_EOL;
    echo "</div>" . PHP_EOL;
    createDynNav($linkArray, $ID);
}

/*
 * This function will check whether the credential inserted by the user are valid
 * by checking them in the file accounts.txt
 * If it returns "true", the user can go in the private area, otherwise an error message will appear.
 * It first open the file after checking if it exists and it's readable, then if one line in the file contains
 * the user name, it will be stored in a variable.
 * This string then is exploded to have an array with all the fields for that user.
 * Username and password contained in the array will be then checked against the ones from the user input.
 *
 * @param: $username
 * @param: $password
 * @return: true or false
 */
function checkCredentials($username, $password){
    $file = "../../private/accounts.txt";

    if (is_file($file) and (is_writable($file) or is_readable($file))){
        $fileToArray = array();
        $accountDetailsArray = array();
        $handle = fopen($file, "r");

        while (!feof($handle)){
            $fileToArray[] = fgets($handle);
        }
        fclose($handle);
        foreach ($fileToArray as $line){
            if (strpos($line, $username)){
                $accountDetailsArray = explode(",",$line);
            }
        }

        if (!empty($accountDetailsArray)) {
            if ($accountDetailsArray[4] === $username and trim($accountDetailsArray[5]) === $password) {
                if ($username == "admin") {
                    $_SESSION["admin"] = $accountDetailsArray[1];
                } else {
                    $_SESSION["user"] = $accountDetailsArray[1];
                }
                return true;
            } else {
                echo "Wrong password for the account $username";
                return false;
            }
        } else {
            echo "Username not found in the database";
            return false;
        }
    }
    return false;
}

// <><><><><><><> The below functions are copied from my previous PHP TMA. It is not plagiarism because that was my own code <><><><><>

/*
 * This function will check whether the user input is a valid name.
 *
 * @param: $string name
 * @return: true or false
 */
function checkName($string){
    if (!ctype_alpha($string) or strlen($string) <= 1 or strlen($string) > 150){
        return false;
    } else {
        return true;
    }
}

/*
 * The below function checks (using the standard PHP library) whether an email is valid or not.
 *
 * @param: $email
 * @return: true or false
 */
function validEmail($email){
    if ($email == "") {
        return false;
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    }
    return false;
}

/*
 * The below function checks whether the user input is valid or not. It must be an alphanumeric string, greater than 5 characters
 *
 * @param: $username string
 * @return: true or false
 */
function validUsername($username){
    if (!ctype_alnum($username) or strlen($username) < 5){
        return false;
    } else {
        return true;
    }
}

// <><><><> END of my old functions. This saved me a bit of work and time.

/*
 * This function saves new details about a user.
 * The fields are passed by the super global array $_SESSION.
 * The function also checks whether the accounts.txt file exists and its writable. If the tests fail, an appropriate error message
 * is returned to the user.
 *
 * @return: true or false
 */
function registerUser() {
    $userData = array(
        $_SESSION["title"],
        $_SESSION["firstname"],
        $_SESSION["lastname"],
        $_SESSION["email"],
        $_SESSION["username"],
        $_SESSION["password"]
    );
    $toWrite = PHP_EOL."$userData[0],$userData[1],$userData[2],$userData[3],$userData[4],$userData[5]";

    // CHANGE THE PATH ON TITAN WEBSERVER!
    $file = "../../private/accounts.txt";

    if (is_file($file) and is_writable($file)) {
        $handle = fopen($file, "a");
        $result = fwrite($handle, $toWrite);
        if ($result === false) {
            echo "<p>Something went wrong while writing the user in the database</p>";
            fclose($handle);
            return false;
        }
        fclose($handle);
        return true;
    }
    echo "<p>The user account file is corrupted or write permission insufficient</p>";
    return false;
}

/*
 * This function will simply do as it says. It'll Destroy destroy the current session and delete
 * all the content of the $_SESSION global array.
 *
 * @param: null
 * @return: null
 */
function logout(){
    //print_r($_SESSION);
    $_SESSION = array();
    session_destroy();
}

/*
 * If an user tries to access to a page on the restricted area, this function will show a message and
 * redirect the user to the login page after a short delay.
 *
 * @param: null
 * @return: null
 */
function accessDenied() {
    echo "<h2 style='color: red'>Access denied. You must log-in first</h2>";
    header("refresh:8; url=login.php");
    echo "<p>You now will be directed to the login page... Please wait.</p>";
}
?>