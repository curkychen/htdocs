<?php
session_start();
?>
/**
 * Created by PhpStorm.
 * User: yiminzhou
 * Date: 12/4/17
 * Time: 15:00
 */
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['addpost'] == "true") {

        $post_brand = $post_price = $post_rating = $post_pet_category = $post_pet_breed = $post_comment = "";
        $post_brandErr = $post_priceErr = $post_ratingErr = $post_pet_categoryErr = "";
        $postErr = "";


        if (empty($_POST['post_brand'])) {
            $post_brandErr = "brand is required";
        } else {
            $post_brand = $_POST['post_brand'];
        }

        if (empty($_POST['post_price'])) {
            $post_priceErr = "price is required";
        } else {
            $post_price = $_POST['post_price'];
        }

        if (empty($_POST['post_rating'])) {
            $post_ratingErr = "rating is required";
        } else {
            $post_rating = $_POST['post_rating'];
        }


        if (empty($_POST['post_pet_category'])) {
            $post_pet_categoryErr = "pet category is required, choose one";
        } else {
            $post_pet_category = $_POST['post_pet_category'];
        }


        $post_pet_breed = $_POST['post_pet_breed'];
        $post_comment = $_POST['post_comment'];
        $post_votenum = 0;



        if (empty($post_brandErr) && empty($post_priceErr) && empty($post_ratingErr) && empty($post_pet_categoryErr)) {
            require('mysqli_connect.php');

            $postuser = $_SESSION['login_user'];

            $sql = "INSERT INTO posts (postuser, brandname, price, rating, petcategory, petbreed, comment, votenumber) 
                VALUES ('$postuser','$post_brand', '$post_price', '$post_rating', '$post_pet_category','$post_pet_breed', '$post_comment', '$post_votenum')";

            $result = @mysqli_query($dbc, $sql);

            if ($result) {

            } else {
                $postErr =  "<h1>" . mysqli_error($dbc) . "</h1>";
            }

        }
    }

    if ($_POST['favor_submit_check'] == "true") {

        require('mysqli_connect.php');

        $adduser = $_SESSION['login_user'];
        $postidfavor = $_POST['favor_id'];
        $postuser = $_POST['favor_postuser'];
        $post_brand = $_POST['favor_brandname'];
        $post_price = $_POST['favor_price'];
        $post_rating = $_POST['favor_rating'];
        $post_pet_category = $_POST['favor_petcategory'];
        $post_pet_breed = $_POST['favor_petbreed'];
        $post_comment = $_POST['favor_comment'];


        $sql = "INSERT INTO favorites (adduser, postid, postuser, brandname, price, rating, petcategory, petbreed, comment) 
                VALUES ('$adduser', '$postidfavor', '$postuser','$post_brand', '$post_price', '$post_rating', '$post_pet_category','$post_pet_breed', '$post_comment')";

        $result = @mysqli_query($dbc, $sql);

        if ($result) {

        } else {
            $postErr =  "<h1>" . mysqli_error($dbc) . "</h1>";
        }
    }


    if ($_POST['vote_submit_check'] == "true") {

        require('mysqli_connect.php');


        $postidvote = $_POST['vote_id'];
        $sqlpre = "SELECT votenumber FROM posts WHERE id='$postidvote'";

        $votenumber = mysqli_fetch_assoc(@mysqli_query($dbc, $sqlpre));

        $newvotenumber = $votenumber['votenumber'] + 1;






        $sql = "update posts set votenumber='$newvotenumber' where id='$postidvote'";

        $result = @mysqli_query($dbc, $sql);

        if ($result) {

        } else {
            $postErr =  "<h1>" . mysqli_error($dbc) . "</h1>";
        }
    }


}


?>



<?php
    include('includes/header.php');
?>

<br>
<div class="centerdiv" style="background-color: antiquewhite;width: fit-content; border-style: groove; padding-left: 16px; padding-right: 16px; width: 50%; margin-bottom: 10px;">
    <h3>Share your favourite food here </h3><br>

    <span class="error"><?php echo($postErr);?></span>

    <form action="profile.php" method="post">

        Food Brand: <input type="text" name="post_brand" "><span class="error">* <?php echo($post_brandErr);?></span><span>&nbsp;&nbsp;</span>

        Price:<input type="text" name="post_price" ><span class="error">* <?php echo($post_priceErr);?></span><span>&nbsp;&nbsp;</span>

        Rating:<input type="number" name="post_rating" min="1" max="5" step="0.5" value="5"><span class="error">* (from 1 to 5)<?php echo($post_ratingErr);?></span><br><br>

        Pet Category:<input type="radio" name="post_pet_category" value="dog">Dog
        <input type="radio" name="post_pet_category" value="cat">Cat
        <input type="radio" name="post_pet_category" value="rabbit">Rabbit
        <input type="radio" name="post_pet_category" value="hamster">Hamster
        <span class="error">* <?php echo($post_pet_categoryErr);?></span><br><br>

        Pet Breed:<input type="text" name="post_pet_breed" ><br><br>

        Comment: <textarea name="post_comment" rows="5" cols="56"></textarea><br><br>
        <input type="hidden" name="addpost" value="true">

        <p><input type="submit" name="submit" value="Add Your Opinion!" /></p>

        <!-- <input type="hidden" name="submitted" value="TRUE" /> -->
    </form>
</div>

<div class="centerdiv">
    <?php
    require_once('mysqli_connect.php');

    $postuser = $_SESSION['login_user'];

    $sql = "SELECT * FROM posts ORDER BY votenumber DESC";
    //WHERE postuser='$postuser'

    $result = @mysqli_query($dbc, $sql);

    if (mysqli_num_rows($result) >= 1) {


        while($row = mysqli_fetch_assoc($result)) {
            echo '<div class="postdisplay">';
            echo "<h3>" . $row["postuser"]. "</h3><br>";
            echo "<h4>BRAND NAME: " . $row["brandname"]. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            echo "RATING: " . $row["rating"]. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            echo "PRICE: " . $row["price"]. "</h4><br>";
            echo "<h4>PET CATEGORY: " . $row["petcategory"]. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            echo "PET BREED: " . $row["petbreed"]. "</h4><br>";
            echo "<h4>COMMENT:" . "<h4>" .$row["comment"]. "</h4><br>";

            echo '<div class="like_favorite">';
            echo '<form action="profile.php" method="post"><input type="hidden" name="favor_id" value="' .$row['id'].'">';
            echo '<input type="hidden" name="favor_postuser" value="'.$row['postuser'].'">';
            echo '<input type="hidden" name="favor_brandname" value="'.$row['brandname'].'">';
            echo '<input type="hidden" name="favor_price" value="'.$row['price'].'">';
            echo '<input type="hidden" name="favor_rating" value="'.$row['rating'].'">';
            echo '<input type="hidden" name="favor_petcategory" value="'.$row['petcategory'].'">';
            echo '<input type="hidden" name="favor_petbreed" value="'.$row['petbreed'].'">';
            echo '<input type="hidden" name="favor_comment" value="'.$row['comment'].'">';
            echo '<input type="hidden" name="favor_submit_check" value="true">';
            echo '<input type="submit" class="submitbutton" name="favor_submit" value="Favorite"></form>';
            echo '</div>';

            echo '<div class="like_favorite">';
            echo '<form action="profile.php" method="post"><input type="hidden" name="vote_id" value="' .$row['id'].'">';
            echo '<input type="hidden" name="vote_submit_check" value="true">';
            echo '<input type="submit" class="submitbutton" name="vote_submit" value="Vote('. $row['votenumber'].')"></form>';
            echo '</div>';

            echo '</div>';
        }
    } else {
        echo $postuser;
        echo "0 results";
    }

    mysqli_close($dbc);

    ?>
</div>

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