<?php
/**
 * Created by PhpStorm.
 * User: Alessandro Arosio
 * Date: 22/03/2018
 * Time: 19:18
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

if ((isset($_SESSION['user']) or (isset($_SESSION['admin'])))) {
    echo "<h2>Welcome to the Admin console</h2>";

    $self = htmlentities($_SERVER["PHP_SELF"]);
    $clean = array();
    $errors = array();

    $formSubmitted = false;
    $errorsDetected = false;

    // Checking whether the inputs are valid or not

    if (isset($_POST["registerButton"])) {
        $formSubmitted = true;
        if (isset($_POST["title"])) {
            $trimmed = trim($_POST["title"]);
            $html = htmlentities($trimmed);
            $clean["title"] = $html;
            $_SESSION["title"] = $html;
        } else {
            $errors["title"] = "Title not set correctly";
            $errorsDetected = true;
        }

        if (isset($_POST["firstname"])) {
            $trimmed = trim($_POST["firstname"]);
            $html = htmlentities($trimmed);
            if (checkName("$html")) {
                $clean["firstname"] = $html;
                $_SESSION["firstname"] = $html;
            } else {
                $errors["firstname"] = $html;
                $errorsDetected = true;
            }
        } else {
            $errors["firstname"] = "First name not set!";
            $errorsDetected = true;
        }

        if (isset($_POST["lastname"])) {
            $trimmed = trim($_POST["lastname"]);
            $html = htmlentities($trimmed);
            if (checkName("$html")) {
                $clean["lastname"] = $html;
                $_SESSION["lastname"] = $html;
            } else {
                $errors["lastname"] = $html;
                $errorsDetected = true;
            }
        } else {
            $errors["lastname"] = "Last name not set!";
            $errorsDetected = true;
        }
        if (isset($_POST["email"])) {
            $trimmed = trim($_POST["email"]);
            $html = htmlentities($trimmed);
            if (validEmail($html)) {
                $clean["email"] = $html;
                $_SESSION["email"] = $html;
            } else {
                $errors["email"] = $html;
                $errorsDetected = true;
            }
        } else {
            $errors["email"] = "Email not set";
            $errorsDetected = true;
        }
        if (isset($_POST["username"])) {
            $trimmed = trim($_POST["username"]);
            $html = htmlentities($trimmed);
            if (validUsername($html)) {
                $clean["username"] = $html;
                $_SESSION["username"] = $html;
            } else {
                $errors["username"] = $html;
                $errorsDetected = true;
            }
        } else {
            $errors["username"] = "User name not set!";
            $errorsDetected = true;
        }
        if (isset($_POST["password"])) {
            $trimmed = trim($_POST["password"]);
            $html = htmlentities($trimmed);
            if (validUsername($html)) {
                $clean["password"] = $html;
                $_SESSION["password"] = $html;
            } else {
                $errors["password"] = $html;
                $errorsDetected = true;
            }
        } else {
            $errors["password"] = "User name not set!";
            $errorsDetected = true;
        }
    }


// Processing the form :)

    if ($formSubmitted === true and empty($errors)) {
        header("Location: confirm.php");
    } else {
        if (!empty($errors)) {
            echo "<p style='color: red'>Please correct the errors in red.</p>";
        }
        if (isset($clean["title"])) {
            $title = $clean["title"];
        } else {
            $title = "";
        }
        if (isset($clean["firstname"])) {
            $firstname = $clean["firstname"];
        } else {
            $firstname = "";
        }
        if (isset($clean["lastname"])) {
            $lastname = $clean["lastname"];
        } else {
            $lastname = "";
        }
        if (isset($clean["email"])) {
            $email = $clean["email"];
        } else {
            $email = "";
        }
        if (isset($clean["username"])) {
            $username = $clean["username"];
        } else {
            $username = "";
        }
        if (isset($clean["password"])) {
            $password = $clean["password"];
        } else {
            $password = "";
        }
    }

    echo '
<p>Create new users with the form below:</p>

<form action="'.$self.'" method="post">
    <fieldset>
        <div>
            <label for="title">Title: </label>
            <select name="title" id="title">
                <option';
    if ($title == "Mr") {
        echo('selected="selected"');
    }
    echo ' '.'value="Mr">Mr</option>
                <option';
    if ($title == "Ms") {
        echo('selected="selected"');
    }
    echo ' '.'value="Ms">Miss</option>
                <option';
    if ($title == "Dr") {
        echo('selected="selected"');
    }
    echo ' '.'value="Dr">Dr</option>
            </select>
        </div>
        <div>
            <label for="firstname">First name: </label>
            <input type="text" name="firstname" id="firstname" value="' . $firstname . '">';

    if (isset($errors["firstname"])) {
        $errorFirstname = $errors["firstname"];
        echo "<span style='color: red'>$errorFirstname is not valid</span>";
    }
    echo '
        </div>
        <div>
            <label for="lastname">Last name: </label>
            <input type="text" name="lastname" id="lastname" value="' . $lastname . '">';

    if (isset($errors["lastname"])) {
        $errorLastname = $errors["lastname"];
        echo "<span style='color: red'>$errorLastname is not valid</span>";
    }
    echo '            
        </div>
        <div>
            <label for="email">Email: </label>
            <input type="text" name="email" id="email" value="' . $email . '">';

    if (isset($errors["email"])) {
        $errorEmail = $errors["email"];
        echo "<span style='color: red'>$errorEmail is not a valid email address</span>";
    }
    echo '            
        </div>
        <div>
            <label for="username">Username: </label>
            <input type="text" name="username" id="username" value="' . $username . '">';

    if (isset($errors["username"])) {
        echo "<span style='color: red'>Username is a required field</span>";
    } else {
        echo "<span>Minimum lenght 6 characters, at least 2 numbers</span>";
    }
    echo '
        </div>
        <div>
            <label for="password">Password: </label>
            <input type="password" name="password" id="password" value="' . $password . '">';

    if (isset($errors["password"])) {
        echo "<span style='color: red'>Password is a required field</span>";
    } else {
        echo "<span>Minimum lenght 6 characters, at least 2 numbers</span>";
    }
    echo '
        </div>
        <div>
            <input type="submit" name="registerButton" value="Register user" />
        </div>
    </fieldset>
</form>';
} else {
    accessDenied();
}
?>
</body>
</html>
