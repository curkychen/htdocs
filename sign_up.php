<?php
session_start();
?>
/**
 * Created by PhpStorm.
 * User: yiminzhou
 * Date: 12/4/17
 * Time: 12:50
 */
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nameError = "";
    $pwError = "";
    $signUpError = "";
    $signUpName = "";
    $signUpPW = "";
    $signUpCategory = "";
    $register_pet_breed = "";
    $generalError = "";
    $redirectionAddress = "";

    if (empty($_POST['username'])) {
        echo 'do not receive username';
        $nameError = "Please enter the username";
    } else {
        $signUpName = $_POST['username'];
    }

    if (empty($_POST['password'])) {
        $pwError = "Please enter the password";
    } else {
       $signUpPW = $_POST['password'];
    }

    if ($_POST['pwReenter'] != $_POST['password']) {
        $signUpError = "Passwords are not consistent";
    }

//    $signUpCategory = $_POST['pet_category'];
    //$register_pet_breed = $_POST['pet_breed'];

    require_once('db_connect.php');
    $sqlpre = "SELECT username FROM users WHERE username='$signUpName'";
    $resultpre = @mysqli_query($dbc, $sqlpre);

    if(mysqli_num_rows($resultpre) >= 1) {
       $generalError = "User already existed!";
    }


    if (empty($nameError) && empty($pwError) && empty($signUpError) && empty($generalError)) {
        require_once('db_connect.php');
        echo 'begin adding data';
//        $sql = "INSERT INTO users (username, password, petcategory, petbreed) VALUES ('$signUpName', '$register_password', '$register_pet_category', '$register_pet_breed')";
        $sql = "INSERT INTO users (username, password) VALUES ('$signUpName', '$signUpPW')";

        $result = @mysqli_query($dbc, $sql);

        if ($result) {
            echo 'success adding data';
            $redirectionAddress = "<h1 class='redirect'>Thank you! Your are now registered. You can <a href=\"login.php\">log in</a></h1>";

        } else {
            echo 'fail to add data';
            echo '<h1>' . mysqli_error($dbc) . '</h1>';
        }
        mysqli_close($dbc);
    }
}


?>

<?php
//
//include('includes/header.php');
//
//?>

<br>
<br>
<br>
<div class="centerdiv">
    <h1>Register</h1>
<!--    <h2>Join us and enjoy your trip with more fun!</h2>-->
    <span class="error"><?php echo($generalError);?></span>
    <span><?php echo($redirectionAddress);?></span>
    <form action="sign_up.php" method="post">

        Userame: <input type="text" name="username" value="<?php echo $signUpName; ?>"><span class="error">* <?php echo($nameError);?></span><br><br>

        Password:<input type="password" name="password" ><span class="error">* <?php echo($pwError);?></span><br><br>

        Confirm Password:<input type="password" name="pwReenter" ><span class="error">* <?php echo($signUpError);?></span><br><br>

<!--        Pet Category:<input type="radio" name="pet_category" --><?php //if (isset($pet_category) && $pet_category=="dog") echo "checked";?><!-- value="dog">Dog-->
<!--        <input type="radio" name="pet_category" --><?php //if (isset($pet_category) && $pet_category=="cat") echo "checked";?><!-- value="cat">Cat-->
<!--        <input type="radio" name="pet_category" --><?php //if (isset($pet_category) && $pet_category=="rabbit") echo "checked";?><!-- value="rabbit">Rabbit-->
<!--        <input type="radio" name="pet_category" --><?php //if (isset($pet_category) && $pet_category=="hamster") echo "checked";?><!-- value="hamster">Hamster<br><br>-->
<!---->
<!--        Pet Breed:<input type="text" name="pet_breed" value="--><?php //echo $register_pet_breed; ?><!--"><br><br>-->

        <p><input type="submit" name="submit" value="Register" /></p>

        <!-- <input type="hidden" name="submitted" value="TRUE" /> -->
    </form>

</div>

</body>
</html>
