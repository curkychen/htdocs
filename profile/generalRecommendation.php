<?php
/**
 * Created by PhpStorm.
 * User: chenran
 * Date: 4/28/18
 * Time: 8:54 PM
 */
session_start();
echo "enter the general recommendation";
require('../script/db/db_connect.php');
if(!isset($_SESSION['login_user'])) {
    echo "cannot find user";
    exit;
}
$postUser = $_SESSION['login_user'];
//            $tag=$_GET["tag"];
//            $sql = "select * from posts right join (select follow.userId2 from follow where userId1 = ".$postUser .") on posts.userId = follow.userId2 order by posts.votes";
$sql = "select * from posts order by votes desc";
$result = @mysqli_query($dbc, $sql);
if(!$result) {
    echo "error in query1_select all posts";
    $postErr =  "<h1>" . mysqli_error($dbc) . "</h1>";
    echo $postErr;
    exit();
}
if (mysqli_num_rows($result) >= 1) {
    while($row = mysqli_fetch_assoc($result)) {
//            echo "<p><a class=\"btn btn-secondary\" href=\"tagContent.php?tag=".$row["tag"]."\" role=\"button\">".$row["tag"]."</a></p>";
        if($row["userId"] == $postUser) {
            continue;
        }
        echo "<li class=\"list-group-item\">
                       <h3>".$row["title"]."</h3>
                       <p>".$row["postDate"]."</p>
                       <p>".$row["content"]."</p>";
        $vote = $row["votes"];
        echo "<button id=\"btnfun\" name=\"btnfun\" onClick='location.href=\"?button".$row["postId"]."=1\"'>Vote</button>";
        if($_GET['button'.$row["postId"]]) {
            updateVote($dbc, $row["postId"], $vote);
        }
//        $user2Id = getUserId($dbc, $row["postId"]);
        $user2Id = $row["userId"];
        follow($dbc,$row["postId"],$postUser,$user2Id);
        echo "<a href=\"otherUserProfile.php?userId=".$row["postId"]."\">View the author profile</a>";
        echo "<p><a href=\"addTag.php?\postId=".$row["postId"]."\">Add to favorite</p>";
        echo "</li>";
    }
} else {
    echo "<p>Nothing inside</p>";
}
mysqli_close($dbc);


//function getUserId($dbc, $postId) {
//    $idQuery = "select * from user_posts where postId = ".$postId;
//    $res_id = @mysqli_query($dbc, $idQuery);
//    if(!$res_id) {
//        echo "error in find id";
//        $postErr =  "<h1>" . mysqli_error($dbc) . "</h1>";
//        echo $postErr;
//        exit();
//    }
//    $row2 = mysqli_fetch_assoc($res_id);
//    $user2Id = $row2["userId"];
//    return $user2Id;
//}

function updateVote($dbc, $postId, $vote) {
    $vote = $vote + 1;
    $sql2 = "update posts set votes = ".$vote . " where postId = " . $postId;
    $result2 = @mysqli_query($dbc, $sql2);
    if(!$result2) {
        echo "error in query2_vote";
        $postErr =  "<h1>" . mysqli_error($dbc) . "</h1>";
        echo $postErr;
        exit();
    }
}

function follow($dbc, $postId, $postUser, $user2Id){
//    $sql3 = "select * from user_posts where postId = ".$postId."left join follow on follow.userId1 = ".$postUser." and follow.userId2 = user_posts.userId";
    $sql3 = "select * from follow where userId1 = ".$postUser." and userId2 = ".$user2Id;
    $result3 =  @mysqli_query($dbc, $sql3);
    if(!$result3) {
        echo "error in query3_checkFollow";
        $postErr =  "<h1>" . mysqli_error($dbc) . "</h1>";
        echo $postErr;
        exit();
    }
    if(mysqli_num_rows($result3) == 0) {
        echo "<button id=\"btnfun2\" name=\"btnfun2\" onClick='location.href=\"?button_follow".$user2Id."=1\"'>Follow the Author</button>";
        if($_GET['button_follow'.$user2Id]) {
            $sql4 = "insert into follow (userId1, userId2) values (".$postUser.",".$user2Id.")";
            $result4 = @mysqli_query($dbc, $sql4);
            if(!$result4) {
                echo "error in query4_start_follow";
                $postErr =  "<h1>" . mysqli_error($dbc) . "</h1>";
                echo $postErr;
                exit();
            }
        }

    }
}