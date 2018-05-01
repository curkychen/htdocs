<?php
/**
 * Created by PhpStorm.
 * User: chenran
 * Date: 4/28/18
 * Time: 4:16 PM
 */
session_start();
/**
 * Created by PhpStorm.
 * User: chenran
 * Date: 4/27/18
 * Time: 8:37 PM
 */

include "../header.php";
?>

<ul class="list-group">
    <?php
    require_once('../script/db/db_connect.php');
    $postUser = $_SESSION['login_user'];
    if($_SERVER["REQUEST_METHOD"] == "GET") {
        if(isset($_GET["vote"])) {
            echo "detect get";
            if(isset($_GET["vote"])) {
                $vote = $_GET["vote"];
                $postId = $_GET["button_vote"];
                $userId = $_GET["userId"];
                updateVote($dbc, $postId, $vote, $userId);
            }
            if(isset($_GET["button_follow"])) {
                $user2Id = $_GET["button_follow"];
                echo "get the button_follow is ".$user2Id;
                followPeople($dbc,$postUser, $user2Id);
            }
        }
        $userId = $_GET["userId"];
        echo "current user".$postUser;
        echo "view the user".$userId;
        $userName = "select username from users WHERE userId=$userId";
        $userName_res = @mysqli_query($dbc, $userName);
        if(!$userName_res) {
            echo "error in name";
            $postErr =  "<h1>" . mysqli_error($dbc) . "</h1>";
            echo $postErr;
            exit();
        }
        $name = mysqli_fetch_assoc($userName_res);
        $userName = $name["username"];
        echo "<p><h1>$userName</h1></p>";
        if(isset($_SESSION['login_user'])) {
            follow($dbc, $postUser, $userId);
        }

        $sql = "select * from posts WHERE userId = ".$userId;
        $result = @mysqli_query($dbc, $sql);
        if (mysqli_num_rows($result) >= 1) {
            while($row = mysqli_fetch_assoc($result)) {
//            echo "<p><a class=\"btn btn-secondary\" href=\"tagContent.php?tag=".$row["tag"]."\" role=\"button\">".$row["tag"]."</a></p>";
                echo "<li class=\"list-group-item\">
                       <h3>".$row["title"]."</h3>
                       <p>".$row["postDate"]."</p>
                       <p>".$row["content"]."</p>";
                $vote = $row["votes"];
                if(isset($_SESSION['login_user'])) {
                    echo "<p><a href='/profile/otherUserProfile.php?button_vote=" . $row["postId"] . "&vote=".$vote."&userId=".$userId."\'>Vote</a></p>";
                    echo "<p><a href=\"/profile/addTag.php?postId=".$row["postId"]."\">Add to favorite</a></p>";
                }
                echo "</li>";
            }
        } else {
            echo "<p>Nothing inside</p>";
        }
    }

    if($_SERVER["REQUEST_METHOD"] == "GET") {
        echo "detect get";
        if(isset($_GET["vote"])) {
            $vote = $_GET["vote"];
            $postId = $_GET["button_vote"];
            $userId = $_GET["userId"];
            updateVote($dbc, $postId, $vote, $userId);
        }
        if(isset($_GET["button_follow"])) {
            $user2Id = $_GET["button_follow"];
            echo "get the button_follow is ".$user2Id;
            followPeople($dbc,$postUser, $user2Id);
        }
    }


    mysqli_close($dbc);

    function follow($dbc, $postUser, $user2Id){
//        echo "enter follow";
        $sql3 = "select * from follow where userId1 = ".$postUser." and userId2 = ".$user2Id;
        $result3 =  @mysqli_query($dbc, $sql3);
        if(!$result3) {
            echo "error in query3_checkFollow";
            $postErr =  "<h1>" . mysqli_error($dbc) . "</h1>";
            echo $postErr;
            exit();
        }
        if(mysqli_num_rows($result3) == 0) {
            echo "<p><a href='/profile/otherUserProfile.php?button_follow=".$user2Id."'>follow</a></p>";
        }
    }

    function updateVote($dbc, $postId, $vote, $userId) {
        $vote = $vote + 1;
        echo $vote;
        echo $postId;
        $sql2 = "update posts set votes = ".$vote." where postId = \"".$postId."\"";
        $result2 = @mysqli_query($dbc, $sql2);
        if(!$result2) {
            echo "error in query2_vote";
            $postErr =  "<h1>" . mysqli_error($dbc) . "</h1>";
            echo $postErr;
            exit();
        }
        $page = 'otherUserProfile.php?userId='.$userId;
        $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
        $url = rtrim($url, '/\\');
        $url .= '/' . $page;
        header("Location: $url");
    }

    function followPeople($dbc, $postUser, $user2Id) {
        $sql4 = "insert into follow (userId1, userId2) values (".$postUser.",".$user2Id.")";
        $result4 = @mysqli_query($dbc, $sql4);
        if(!$result4) {
            echo "error in query4_start_follow";
            $postErr =  "<h1>" . mysqli_error($dbc) . "</h1>";
            echo $postErr;
            exit();
        }
        $page = 'otherUserProfile.php?userId='.$user2Id;
        $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
        $url = rtrim($url, '/\\');
        $url .= '/' . $page;
        header("Location: $url");
    }
    ?>
</ul>