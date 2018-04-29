<?php
session_start();
?>

<?php
//    include('search.php');
include ('header.php');
?>
<br>

<div class="centerdiv" style="background-color: #FFDCB9;width: fit-content; border-style: none; padding-left: 16px; padding-right: 16px; width: 50%; margin-bottom: 10px;">
    <h1 style="color: darkblue">New here? Suggestions for you!</h1>
    <div style="text-align: center; font-family: 'Andale Mono'; font-size: 18px;">
        <a href="sign_up.php">Want to have more fun? Register here!</a><br>
        <a href="login.php">Have registered? Login here to share your opinion!</a><br>
        Searching for pet category and breed on navigation bar :)<br>
        Searching what you like in searching field! Try it now!<br><br>
    </div>
</div>




<div class="centerdiv col-sm-4">

    <h3>Lots of pet categories and breeds:</h3>
    <br>
    <?php
    require('mysqli_connect.php');

    $postuser = $_SESSION['login_user'];

    $sql_pet = "SELECT petcategory,petbreed FROM posts";
    //WHERE postuser='$postuser'

    $result = @mysqli_query($dbc, $sql_pet);

    if (mysqli_num_rows($result) >= 1) {


        while($row = mysqli_fetch_assoc($result)) {

            echo '<p style="font-family: Zapfino;font-style: italic;font-size: 16px">';
            echo $row['petcategory']. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            echo $row['petbreed']. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            echo '</p>';

        }
    } else {
        echo $postuser;
        echo "0 results";
    }

    mysqli_close($dbc);

    ?>
</div>

<div class="centerdiv col-sm-4">

    <h3>Lots of pet food brand:</h3>
    <br>
    <?php
    require('mysqli_connect.php');

    $postuser = $_SESSION['login_user'];

    $sql_brand = "SELECT brandname FROM posts";
    //WHERE postuser='$postuser'

    $result = @mysqli_query($dbc, $sql_brand);

    if (mysqli_num_rows($result) >= 1) {


        while($row = mysqli_fetch_assoc($result)) {

            echo '<p style="font-family: Zapfino;font-style: italic;font-size: 16px">';
            echo $row['brandname']. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            echo '</p>';

        }
    } else {
        echo $postuser;
        echo "0 results";
    }

    mysqli_close($dbc);

    ?>
</div>


<div class="centerdiv col-sm-4">

    <h3>Lots of other users and comments:</h3>
    <br>
    <?php
    require('mysqli_connect.php');

    $postuser = $_SESSION['login_user'];

    $sql_user_comment = "SELECT postuser,comment FROM posts";
    //WHERE postuser='$postuser'

    $result = @mysqli_query($dbc, $sql_user_comment);

    if (mysqli_num_rows($result) >= 1) {


        while($row = mysqli_fetch_assoc($result)) {

            echo '<p style="font-family: Zapfino;font-style: italic;font-size: 16px">';
            echo $row['postuser']. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            echo $row['comment']. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            echo '</p>';

        }
    } else {
        echo $postuser;
        echo "0 results";
    }

    mysqli_close($dbc);

    ?>
</div>



<!--<div class="centerdiv">-->
<!--    <button class="gotobutton" style="background-color: #FFDCB9"><a href="register.php">Ready?GO!</a></button>-->
<!---->
<!--</div>-->






<!--<form action="homepage.php">-->
<!--    <input type="hidden" name="like_id" value="$row['id']">-->
<!--    <input type="hidden" name="like_postuser" value="$row['postuser']">-->
<!--    <input type="hidden" name="like_brandname" value="$row['brandname']">-->
<!--    <input type="hidden" name="like_price" value="$row['price']">-->
<!--    <input type="hidden" name="like_rating" value="$row['rating']">-->
<!--    <input type="hidden" name="like_petcategory" value="$row['petcategory']">-->
<!--    <input type="hidden" name="like_petbreed" value="$row['petbreed']">-->
<!--    <input type="hidden" name="like_comment" value="$row['comment']">-->
<!--    <input type="submit" name="like_submit" value="Like">-->
<!--</form>-->


</body>
</html>