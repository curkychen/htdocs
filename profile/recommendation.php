<?php
session_start();
/**
 * Created by PhpStorm.
 * User: chenran
 * favorite7/18
 * Time: 8:37 PM
 */

include "../header.php";
?>
<script src="profile.js"></script>
<p>
    <a class="btn btn-primary" data-toggle="collapse" href="#followingRecommendation" aria-expanded="false" aria-controls="followingRecommendation">
        Following Recommendation
    </a>
    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#generalRecommendation" aria-expanded="false" aria-controls="generalRecommendation">
        Recommendation
    </button>
    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#friendList" aria-expanded="false" aria-controls="friendList">
        Following people
    </button>
    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#notifications" aria-expanded="false" aria-controls="notifications">
        Notification
    </button>
</p>
<div class="collapse" id="followingRecommendation">
    <div class="card card-block">
<!--        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.-->
        <ul class="list-group">
            <?
            include "followingRecommendation.php";
            ?>
        </ul>
    </div>
</div>
<div class="collapse" id="generalRecommendation">
    <div class="card card-block">
<!--        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.-->
        <ul class="list-group">
            <?
            include "generalRecommendation.php";
            ?>
        </ul>
    </div>
</div>
<div class="collapse" id="friendList">
    <div class="card card-block">
<!--        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.-->
        <ul class="list-group">
            <?
            require_once('../script/db/db_connect.php');
            $postUser = $_SESSION['login_user'];
            //            $tag=$_GET["tag"];
            $sql = "select * from follow WHERE userId1 = ". $postUser;
            $result = @mysqli_query($dbc, $sql);
            if (mysqli_num_rows($result) >= 1) {
                while($row = mysqli_fetch_assoc($result)) {
//            echo "<p><a class=\"btn btn-secondary\" href=\"tagContent.php?tag=".$row["tag"]."\" role=\"button\">".$row["tag"]."</a></p>";
                    echo "<li class=\"list-group-item\">
                            <p>".$row["userId2"]."</p>
                            <a href=\"otherUserProfile.php?userId=".$row["userId2"]."\">View profile</a>
                          </li>";
                }
            } else {
                echo "<p>Nothing inside</p>";
            }
            mysqli_close($dbc);
            ?>
        </ul>
    </div>
</div>
<div class="collapse" id="notifications">
    <div class="card card-block">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
    </div>
</div>