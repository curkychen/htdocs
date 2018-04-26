<?php
/**
 * Created by PhpStorm.
 * User: chenran
 * Date: 4/24/18
 * Time: 7:03 PM
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $loginErrorName = "";
    $loginErrorPW = "";
    $loginUserName = "";
    $loginPW = "";
    $errorMessage = "";

    if (empty($_POST['username'])) {
        $loginErrorName = "Please enter the valid user name!";
    } else {
        $loginUserName = $_POST['username'];
    }

    if (empty($_POST['password'])) {
        $loginErrorPW = "Please enter the password";
    } else {
        $loginPW = $_POST['password'];
    }

    if (empty($loginErrorName) && empty($loginErrorPW)) {
//		we only need to connect sql for one time
        require_once('../../db_connect.php');
        $sql = "SELECT username FROM users WHERE username='$loginUserName' AND password='$loginPW'";

        $result = @mysqli_query($dbc, $sql);

        if (mysqli_num_rows($result) == 1) {

            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            //setcookie('login_user', $row['username']);
            $_SESSION['login_user'] = $row['username'];

            $page = 'profile.php';
            $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
            $url = rtrim($url, '/\\');
            $url .= '/' . $page;

            header("Location: $url");
            exit();
        } else {
            $errorMessage =  "Invalid username or password";
        }
        mysqli_close($dbc);
    }
}
