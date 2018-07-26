<?php
session_start();
if ($_SESSION['valid'] == false) {
    header("location: login.php");
    die();
}

$prev_first_number = $_POST["first_number"];
$prev_second_number = $_POST["second_number"];
$prev_logic = $_POST["operation"];
$prev_answer = $_POST["answer"];
$array_logic = array("+", "-");
$_SESSION["logic"] = $array_logic[rand(0, 1)];
$_SESSION["ran1"] = rand(0, 50);
$_SESSION["ran2"] = rand(0, 50);
$_SESSION["ranadd"] = ($_SESSION["first"] + $_SESSION["second"]);
$_SESSION["ranminus"] = ($_SESSION["first"] - $_SESSION["second"]);
$_SESSION["result"] =
$_SESSION["submit"] = $_POST["submit"];

if ($prev_logic == "+") {
    $y = ($prev_first_number + $prev_second_number);
} else {
    $y = ($prev_first_number - $prev_second_number);
}

if (!empty($prev_answer)) {
    $_SESSION["total"] += 1;

    if ($prev_answer == $y) {
        $_SESSION["score"] += 1;
        $message_to_show = '<div id="green"> Correct!' . '</div>';

    } else if ($prev_answer !== $y) {
        $message_to_show = '<div id="red"> Incorrect ,' . '&nbsp' . $prev_first_number . '&nbsp' . $prev_logic . '&nbsp' . $prev_second_number . '&nbsp' . "=" . '&nbsp' . $y . "</div>";
    }
} else {
    $_SESSION["total"] += 0;
    $_SESSION["score"] += 0;
    $message_to_show = "Please enter a number for your answer.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Math Game</title>
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="style/math.css">
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="container-fluid">
    <form action="index.php" method="post" role="form" class="form-horizontal">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4"><h1>Math Game</h1></div>
        </div>
        <div class="row">
            <label class="col-sm-2 col-sm-offset-3"><?php echo $_SESSION["ran1"] ?></label>
            <label class="col-sm-2"><?php echo $_SESSION["logic"] ?></label>
            <label class="col-sm-2"><?php echo $_SESSION["ran2"] ?></label>
            <div class="col-sm-3"></div>
        </div>
        <input type="hidden" name="first_number" value="<?php print ($_SESSION["ran1"]) ?>">
        <input type="hidden" name="operation" value="<?php print $_SESSION["logic"]; ?>">
        <input type="hidden" name="second_number" value="<?php print ($_SESSION["ran2"]) ?>">
        <div class="form-group">
            <div class="col-sm-3 col-sm-offset-4">
                <input type="text" class="form-control" id="answer" name="answer" placeholder="Enter answer" size="6"
                       value="">
            </div>
            <div class="col-sm-5"></div>
        </div>
        <div class="row">
            <div class="col-sm-3 col-sm-offset-4">
                <input type="submit" value="Submit" class="btn btn-primary button-sm">
                <a href="logoutprocess.php" class="btn btn-primary button-sm">Logout</a>
            </div>
            <div class="col-sm-3"></div>
            <div class="row">
                <div class="col-sm-3 col-sm-offset-4">
                    <?php echo $message_to_show; ?>
                </div>
            </div>
    </form>
    <hr>
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4"></div>
        <div class="col-sm-4"></div>
    </div>
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4"><?php echo "Score: " . $_SESSION["score"] . "/" . $_SESSION["total"] ?></div>
        <?php echo $_SESSION["correct"] ?>
        <div class="col-sm-4"></div>
    </div>
</div>
</body>
</html>