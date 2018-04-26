<?php
/**
 * Created by PhpStorm.
 * User: chenran
 * Date: 4/24/18
 * Time: 7:03 PM
 */

//echo "successfully include the php!";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "sign up";
    $nameError = "";
    $pwError = "";
    $signUpError = "";
    $signUpName = "";
    $signUpPW = "";
    $signUpCategory = "";
    $register_pet_breed = "";
    $generalError = "";
    $redirectionAddress = "";
    $loginUserName = "";
    $loginPW ="";
    //echo "sign up";
    if (!empty($_POST['signUpName'])) {
        $signUpName = $_POST['signUpName'];
    }
    if (!empty($_POST['signUpPassword'])) {
        $signUpPW = $_POST['signUpPassword'];
    }
    if (!empty($_POST['signInName'])) {
        $loginUserName = $_POST['username'];
    }
    if (empty($_POST['signInPassword'])) {
        $loginPW = $_POST['signInPassword'];
    }
    require_once('../db/db_connect.php');
    if($signUpName != null && $signUpPW != null) {
        if (signUp($signUpName, $signUpPW, $dbc)){
            echo 'success adding data';
            $redirectionAddress = "<h1 class='redirect'>Thank you! Your are now registered. You can <a href=\"../../login.php\">log in</a></h1>";
        } else {
            $generalError = "User already existed!";
        }
    } else if ($loginUserName != null && $loginPW != null) {
        if(signIn($loginUserName, $loginPW, $dbc)){
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            //setcookie('login_user', $row['username']);
            $_SESSION['login_user'] = $row['loginUserName'];

            $page = 'profile.php';
            $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
            $url = rtrim($url, '/\\');
            $url .= '/' . $page;

            header("Location: $url");
            exit();
        } else {
            $errorMessage =  "Invalid username or password";
        }
    }
    mysqli_close($dbc);
} else {
    echo "do not get it";
}


function signIn($loginUserName, $loginPW, $dbc) {

    $sql = "SELECT username FROM users WHERE username='$loginUserName' AND password='$loginPW'";

    $result = @mysqli_query($dbc, $sql);

    if (mysqli_num_rows($result) == 1) {
        return true;
    } else {
        return false;
    }
}
function signUp($signUpName, $signUpPW, $dbc) {
    echo 'enter sign up';
        require_once('../db/db_connect.php');
        $sqlpre = "SELECT username FROM users WHERE username='$signUpName'";
        $resultpre = @mysqli_query($dbc, $sqlpre);

        if(mysqli_num_rows($resultpre) >= 1) {
            return false;
        } else {
            echo 'begin adding data';
//        $sql = "INSERT INTO users (username, password, petcategory, petbreed) VALUES ('$signUpName', '$register_password', '$register_pet_category', '$register_pet_breed')";
            $sql = "INSERT INTO users (username, password) VALUES ('$signUpName', '$signUpPW')";

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