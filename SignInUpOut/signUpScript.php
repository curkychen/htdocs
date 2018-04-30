<?php
/**
 * Created by PhpStorm.
 * User: chenran
 * Date: 4/26/18
 * Time: 3:48 PM
 */

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "sign up";
    $nameError = "";
    $pwError = "";
    $signUpError = "";
    $signUpName = "";
    $signUpPW = "";
    $signUpEmail = "";
    $signUpCategory = "";
    $register_pet_breed = "";
    $generalError = "";
    $redirectionAddress = "";
    $loginUserName = "";
    $loginPW = "";
    //echo "sign up";
    if (!empty($_POST['username'])) {
        $signUpName = $_POST['username'];
    }
    if (!empty($_POST['email'])) {
        $signUpEmail = $_POST['email'];
    }

    if (!empty($_POST['password'])) {
        $signUpPW = $_POST['password'];
    }
    require_once('../script/db/db_connect.php');
    if($signUpName != null && $signUpPW != null && $signUpEmail != null) {
        if (signUp($signUpName, $signUpPW, $dbc, $signUpEmail)){
            echo 'success adding data';
//            $redirectionAddress = "<h1 class='redirect'>Thank you! Your are now registered. You can <a href=\"signIn.html\">log in</a></h1>";
            echo "<h1 class='redirect'>Thank you! Your are now registered. You can <a href=\"signIn.html\">log in</a></h1>";
        } else {
            $generalError = "User already existed!";
            echo $generalError;
            echo "<h1 class='redirect'>Please  <a href=\"signUp.html\">sign up again or <a href=\"signIn.html\">log in</a></h1>";

        }
    }
    mysqli_close($dbc);
}

//function signIn($loginUserName, $loginPW, $dbc) {
//
//    $sql = "SELECT username FROM users WHERE username='$loginUserName' AND password='$loginPW'";
//
//    $result = @mysqli_query($dbc, $sql);
//
//    if (mysqli_num_rows($result) == 1) {
//        return true;
//    } else {
//        return false;
//    }
//}
function signUp($signUpName, $signUpPW, $dbc, $signUpEmail) {
    echo 'enter sign up';
    require_once('../script/db/db_connect.php');
    $sqlpre = "SELECT username FROM users WHERE username='$signUpName'";
    $resultpre = @mysqli_query($dbc, $sqlpre);

    if(mysqli_num_rows($resultpre) >= 1) {
        return false;
    } else {
        echo 'begin adding data';
//        $sql = "INSERT INTO users (username, password, petcategory, petbreed) VALUES ('$signUpName', '$register_password', '$register_pet_category', '$register_pet_breed')";
        //encrypt
        $signUpPW = $signUpPW ."m";
        $sql = "INSERT INTO users (username, password, email) VALUES ('$signUpName', '$signUpPW' ,'$signUpEmail')";

        $result = @mysqli_query($dbc, $sql);

        if ($result) {
            return true;
        } else {
            echo 'fail to add data';
            echo '<h1>' . mysqli_error($dbc) . '</h1>';
            return fasle;
        }
    }
}