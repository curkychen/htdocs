<?php
/**
 * Created by PhpStorm.
 * User: chenran
 * Date: 4/26/18
 * Time: 3:48 PM
 */

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "sign up";
    $signInName = "";
    $signInPW = "";
    //echo "sign up";
    if (!empty($_POST['username'])) {
        $signInName = $_POST['username'];
    }

    if (!empty($_POST['password'])) {
        $signInPW = $_POST['password'];
    }
    require_once('../script/db/db_connect.php');
    if( $signInName != null && $signInPW != null) {
        if (signIn($signInName, $signInPW , $dbc)){
            echo 'success logIn';
            mysqli_close($dbc);
            exit();
        } else {
            //$generalError = "Invalid username or password";
            echo "<h1> Invalid username or password</h1>";
            echo "<h1 class='redirect'>Please <a href=\"signIn.html\">log in</a> again</h1>";
        }
    }
    mysqli_close($dbc);
}

function signIn($loginUserName, $loginPW, $dbc) {
    //encrypt
    $loginPW = $loginPW."m";
    $sql = "SELECT userId FROM users WHERE username='$loginUserName' AND password='$loginPW'";

    $result = @mysqli_query($dbc, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        session_start();
        $_SESSION['login_user'] = $row['userId'];
        $_SESSION['login_userName'] = $loginUserName;
        $page = '../profile/profile.php';
        $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
        $url = rtrim($url, '/\\');
        $url .= '/' . $page;
        header("Location: $url");
        return true;
    } else {
        return false;
    }
}
//function signUp($signUpName, $signUpPW, $dbc, $signUpEmail) {
//    echo 'enter sign up';
//    require_once('../script/db/db_connect.php');
//    $sqlpre = "SELECT username FROM users WHERE username='$signUpName'";
//    $resultpre = @mysqli_query($dbc, $sqlpre);
//
//    if(mysqli_num_rows($resultpre) >= 1) {
//        return false;
//    } else {
//        echo 'begin adding data';
////        $sql = "INSERT INTO users (username, password, petcategory, petbreed) VALUES ('$signUpName', '$register_password', '$register_pet_category', '$register_pet_breed')";
//        $sql = "INSERT INTO users (username, password, email) VALUES ('$signUpName', '$signUpPW' ,'$signUpEmail')";
//
//        $result = @mysqli_query($dbc, $sql);
//
//        if ($result) {
//            return true;
//        } else {
//            echo 'fail to add data';
//            echo '<h1>' . mysqli_error($dbc) . '</h1>';
//            return fasle;
//        }
//    }
//}