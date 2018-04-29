<?php
if($_GET){
    if(isset($_GET['insert'])){
        insert();
    }elseif(isset($_GET['select'])){
        select();
    }
}

function select()
{
    echo "The select function is called.";
}
function insert()
{
    echo "The insert function is called.";
}

?>.


<input type="submit" class="button" name="insert" value="insert" />
<input type="submit" class="button" name="select" value="select" />

===============================================



<?php
if($_GET['button1']){select();}
if($_GET['button2']){insert();}

function fun1()
{
    //This function will update some column in database to 1
}
function fun2()
{
    //This function will update some column in database to 2
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
</head>
<body>
<button id="btnfun1" name="btnfun1" onClick='location.href="?button1=1"'>Update to 1</button>
<button id="btnfun2" name="btnfun2" onClick='location.href="?button2=1"'>Update to 2</button>
</body>
</html>