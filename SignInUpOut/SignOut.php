<?php
/**
 * Created by PhpStorm.
 * User: chenran
 * Date: 4/27/18
 * Time: 10:07 PM
 */
session_start();
?>

<?php
session_unset();
session_destroy();
include('../header.php');
?>
<br>
<br>
<br>
<div class="centerdiv">
    <h1>Logged out</h1>
    <h2 class="redirect">Go back to Login Page! <a href="signIn.html">log in</a></h2>

</div>
