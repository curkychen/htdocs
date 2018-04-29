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
    echo "enter the post";
    $register_nameErr = $register_pwdErr = $register_confirm_pwdErr = "";
    $register_username = $register_password = $register_pet_category = $register_pet_breed = "";
    $registerErr = $registerRedirect = "";

    if (empty($_POST['username'])) {
        $register_nameErr = "username is required";
    } else {
        $register_username = $_POST['username'];
    }

    if (empty($_POST['password'])) {
        $register_pwdErr = "password is required";
    } else {
        $register_password = $_POST['password'];
    }

    if ($_POST['confirm_password'] != $_POST['password']) {
        $register_confirm_pwdErr = "confirm password should be the same as password";
    }

    $register_pet_category = $_POST['pet_category'];
    $register_pet_breed = $_POST['pet_breed'];

    require_once('script/db/db_connect.php');
    $sqlpre = "SELECT username FROM users WHERE username='$register_username'";
    $resultpre = @mysqli_query($dbc, $sqlpre);

    if(mysqli_num_rows($resultpre) >= 1) {
        $registerErr = "User already existed!";
    }


    if (empty($register_nameErr) && empty($register_pwdErr) && empty($register_confirm_pwdErr) && empty($registerErr)) {
        require_once('script/db/db_connect.php');

        $sql = "INSERT INTO users (username, password, petcategory, petbreed) VALUES ('$register_username', '$register_password', '$register_pet_category', '$register_pet_breed')";

        $result = @mysqli_query($dbc, $sql);

        if ($result) {
            $registerRedirect = "<h1 class='redirect'>Thank you! Your are now registered. You can <a href=\"login.php\">log in</a></h1>";

        } else {
            echo '<h1>' . mysqli_error($dbc) . '</h1>';
        }
        mysqli_close($dbc);
    }
}


?>

<?php

include('includes/search.php');

?>

<br>
<br>
<br>
<div class="centerdiv">
    <h1>Register</h1>
    <h2>Join us and enjoy your trip with more fun!</h2>
    <span class="error"><?php echo($registerErr);?></span>
    <span><?php echo($registerRedirect);?></span>
    <form action="register.php" method="post">

        Userame: <input type="text" name="username" value="<?php echo $login_username; ?>"><span class="error">* <?php echo($register_nameErr);?></span><br><br>

        Password:<input type="password" name="password" ><span class="error">* <?php echo($register_pwdErr);?></span><br><br>

        Confirm Password:<input type="password" name="confirm_password" ><span class="error">* <?php echo($register_confirm_pwdErr);?></span><br><br>

        Pet Category:<input type="radio" name="pet_category" <?php if (isset($pet_category) && $pet_category=="dog") echo "checked";?> value="dog">Dog
        <input type="radio" name="pet_category" <?php if (isset($pet_category) && $pet_category=="cat") echo "checked";?> value="cat">Cat
        <input type="radio" name="pet_category" <?php if (isset($pet_category) && $pet_category=="rabbit") echo "checked";?> value="rabbit">Rabbit
        <input type="radio" name="pet_category" <?php if (isset($pet_category) && $pet_category=="hamster") echo "checked";?> value="hamster">Hamster<br><br>

        Pet Breed:<input type="text" name="pet_breed" value="<?php echo $register_pet_breed; ?>"><br><br>

        <p><input type="submit" name="submit" value="Register" /></p>

        <!-- <input type="hidden" name="submitted" value="TRUE" /> -->
    </form>

</div>

</body>
</html>
