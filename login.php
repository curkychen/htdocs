<?php
session_start();
//include('script/signInUp/signIn.php');
include('script/signInUp/signUp.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.js"></script>
<!--    <script src="script/signInUp/signIn.js"></script>-->
    <script src="script/signInUp/signUp.js"></script>
</head>
<body>
<div id="signIn" align="center">
<!--	<h2>Enjoy your trip with more fun!</h2>-->
    <span class="error"><?php echo($errorMessage);?></span>
	<form class="well form-horizontal" action="script/signInUp/signIn.php" method="post">
        <fieldset>
            <legend>Log In</legend>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">User Name</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input  name="signInName" placeholder="User Name" class="form-control"  type="text">
                    </div>
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Password</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input class="form-control" placeholder="Password" name="signInPassword" type="text">
                    </div>
                </div>
            </div>
            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-warning" >Log In <span class="glyphicon glyphicon-send"></span></button>
                </div>
            </div>
        </fieldset>

<!--		Userame: <input type="text" name="username" value="--><?php //echo $loginUserName; ?><!--"><span class="error">* --><?php //echo($loginErrorName);?><!--</span><br><br>-->
<!--		-->
<!--		Password:<input type="password" name="password" ><span class="error">* --><?php //echo($loginErrorPW);?><!--</span><br><br>-->
<!--		-->
<!--		<p><input type="submit"  class="submitbutton" name="submit" value="Log In" /></p>-->
		<!-- <input type="hidden" name="submitted" value="TRUE" /> -->
	</form>
</div>

<div id="signUp" align="center">
        <form class="well form-horizontal" action="script/signInUp/signUp.php" method="post"  id="contact_form">
<!--            <fieldset>-->
                <!-- Form Name -->
                <legend>Join Us Today!</legend>

                <!-- Text input-->

                <div class="form-group">
                    <label class="col-md-4 control-label">User Name</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input  name="signUpName" placeholder="User Name" class="form-control"  type="text" value="<?php echo $signUpName; ?>">
                        </div>
                    </div>
                </div>

                <!-- Text input-->
<!--                <div class="form-group">-->
<!--                    <label class="col-lg-3 control-label">Password</label>-->
<!--                    <div class="col-lg-5">-->
<!--                        <input type="password" placeholder="Password" class="form-control" name="password" />-->
<!--                    </div>-->
<!--                </div>-->
                <div class="form-group">
                    <label class="col-lg-3 control-label">Password</label>
                    <div class="col-lg-5">
                        <input type="password" class="form-control" name="password" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">Retype password</label>
                    <div class="col-lg-5">
                        <input type="password" class="form-control" name="confirmPassword" />
                    </div>
                </div>
<!--                <div class="form-group">-->
<!--                    <label class="col-md-4 control-label"></label>-->
<!--                    <div class="col-md-4">-->
<!--                        <button type="submit" class="btn btn-warning" >Register <span class="glyphicon glyphicon-send"></span></button>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </fieldset>-->
            <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-4">
<!--                    <button type="submit" class="btn btn-warning" >Register <span class="glyphicon glyphicon-send"></span></button>-->
                    <p><input type="submit"  class="submitbutton" name="submit" value="Register" /></p>
                </div>
            </div>
        </form>
<!--    use this command to check the request type-->
    <?php echo $_SERVER["REQUEST_METHOD"]; ?>
    <span class="error"><?php echo($generalError);?></span>
</div><!-- /.container -->

</body>
</html>

