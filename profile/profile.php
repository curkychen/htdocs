<?php
session_start();
?>
<?php
    include('../header.php');
    //include('includes/searchPage.php');
?>


<main role="main">

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-3">Hello!
                <?php
                    echo $_SESSION['login_userName'];
                ?>
            </h1>
<!--            <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>-->
            <p><a class="btn btn-primary btn-lg" href="post.html" role="button">Share your recipe!</a></p>
        </div>
    </div>

    <div class="container">
        <!-- Example row of columns -->
        <div class="row">
            <div class="col-md-4">
                <h2>View your history post</h2>
<!--                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>-->
                <p><a class="btn btn-secondary" href="userHistory.php" role="button">View details &raquo;</a></p>
            </div>
            <div class="col-md-4">
                <h2>Explore food</h2>
<!--                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>-->
                <p><a class="btn btn-secondary" href="recommendation.php" role="button">View details &raquo;</a></p>
            </div>
            <div class="col-md-4">
                <h2>Brows your favorite</h2>
<!--                <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>-->
                <?php
                require_once('../script/db/db_connect.php');
                $postuser = $_SESSION['login_user'];
                $sql = "select DISTINCT tag from favorite left join tags on favorite.postId = tags.postId where favorite.userId = '$postuser'";
                $result = @mysqli_query($dbc, $sql);
                if (mysqli_num_rows($result) >= 1) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<p><a class=\"btn btn-secondary\" href=\"favorite.php?tag=".$row["tag"]."\" role=\"button\">".$row["tag"]."</a></p>";
                    }
                } else {
                    echo "<p>Do not create any favorite tag yet</p>";
                }
                mysqli_close($dbc);
                ?>
<!--                <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>-->
            </div>
        </div>

        <hr>

    </div> <!-- /container -->

</main>



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
