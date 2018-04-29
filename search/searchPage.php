<?php
    session_start();
    include("../header.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!--	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
<!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
	<title>Every day cooking</title>
</head>

<body class="mainbody">
	<div id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
		<div class="jumbotron text-center">
		  <h1>Enjoy your life, Enjoy your food</h1>
		  <p>Search the recipe</p>
		  <form action="searchPage.php" method="post">
		    <div class="input-group">
                <input type="hidden" name="search_post" value="true">
                <input type="checkbox" name="Breakfast" value="Breakfast" checked="checked" /> Breakfast
                <input type="checkbox" name="Lunch" value="Lunch" checked="checked" /> Lunch
                <input type="checkbox" name="Dinner" value="Dinner" checked="checked" /> Dinner
                <input type="checkbox" name="Dessert" value="Dessert" checked="checked" /> Dessert
                <input type="text" class="form-control" name="search_string" size="50" placeholder="What do you want to know?" required>
		      <div class="input-group-btn">
		        <input type="submit" class="btn btn-danger" value="Search">
		      </div>
		    </div>
		  </form>
		</div>
	</div>
    <?php
    require_once('../script/db/db_connect.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $search = "";
        if(isset($_POST["search_string"])) {
            $search = $_POST["search_string"];
        }
        $lunch = false;
        $breakfast = false;
        $dinner = false;
        $dessert = false;
        if($_POST["Lunch"]) {
            $lunch = true;
        }
        if($_POST["Dinner"]) {
            $dinner = true;
        }
        if($_POST["Dessert"]) {
            $dessert = true;
        }
        if($_POST["Breakfast"]) {
            $breakfast = true;
        }
        $searchEngine = new SearchEngineForCook();
        $uncommon_words = $searchEngine->searchByQuery($search);
        $uncommonlength = count($uncommon_words);
        $querypre = "title LIKE '%$uncommon_words[0]%'";
        $querypre = $querypre." OR Content LIKE '%$uncommon_words[0]%'";
        $querypre = $querypre." OR tag LIKE '%$uncommon_words[0]%'";
        $querypre = $querypre." OR Category LIKE '%$uncommon_words[0]%'";
        for($y = 1; $y < $uncommonlength; $y++) {
            $querypre = $querypre . " OR title LIKE '%$uncommon_words[$y]%'";
            $querypre = $querypre . " OR Content LIKE '%$uncommon_words[$y]%'";
            $querypre = $querypre . " OR tag LIKE '%$uncommon_words[$y]%'";
            $querypre = $querypre . " OR Category LIKE '%$uncommon_words[$y]%'";
        }
        $sql = "select * from posts where ".$querypre." order by votes desc";
        $result = @mysqli_query($dbc, $sql);
        if (mysqli_num_rows($result) >= 1) {
            while($row = mysqli_fetch_assoc($result)) {
                if(isset($_SESSION['login_user'])){
                    $postUser = $_SESSION['login_user'];
                    echo "<li class=\"list-group-item\">
                       <h3>".$row["title"]."</h3>
                       <p>".$row["postDate"]."</p>
                       <p>".$row["Content"]."</p>";
                    $vote = $row["votes"];
                    echo "<button id=\"btnfun\" name=\"btnfun\" onClick='location.href=\"?button".$row["postId"]."=1\"'>Vote</button>";
                    if($_GET['button'.$row["postId"]]) {
                        $vote = $vote + 1;
                        $sql2 = "update posts set votes = .".$vote . " where postId = " . $row["postId"];
                        $result2 = @mysqli_query($dbc, $sql2);
                    }
                    $sql3 = "select * from follow where userId1 = ".$postUser." and userId2 = ".$row["userId"];
                    $result3 =  @mysqli_query($dbc, $sql3);
                    if(mysqli_num_rows($result3) == 0) {
                        echo "<button id=\"btnfun2\" name=\"btnfun2\" onClick='location.href=\"?button_follow".$row["userId"]."=1\"'>Follow the Author</button>";
                        if($_GET['button_follow'.$row["userId"]]) {
                            $sql4 = "insert into follow (userId1, userId2) values (".$postUser.",".$row["userId"].")";
                            $result2 = @mysqli_query($dbc, $sql);
                        }
                    }
                    echo "<a href=\"otherUserProfile.php?userId=".$row["postId"]."\">View the author profile</a>";
                    echo "<p><a href=\"addTag.php?\postId=".$row["postId"].">Add to favorite</p>";
                    echo "</li>";
                } else {
                    echo "<li class=\"list-group-item\">
                       <h3>" . $row["title"] . "</h3>
                       <p>" . $row["postDate"] . "</p>
                       <p>" . $row["Content"] . "</p>";
                    echo "</li>";
                }
            }
        } else {
            echo "<p>Nothing inside</p>";
        }
        mysqli_close($dbc);
    }
    ?>
</body>


