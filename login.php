<?php
session_start();
if (isset($_POST['password']) || isset($_POST['email'])) {
    $message_to_send = "";
    $msg = "";
    if (!isset($_POST['password'])) {
        $msg = $_GET["msg"];
    }

    $settings = file_get_contents('credentials.config');
    $string = str_replace(',', "\n", $settings); // Replaces all spaces with newline
    $txt = explode("\n", $string);


    foreach ($txt as $key => $v) {
        $txt[$key] = trim($v);
    }

    $i = 0;

    while ($i < count($txt)) {
        if ($i % 2 == 0) {
            if ($_POST['email'] == $txt[$i]) {
                $emailval = true;

            } else {
                $emailval = false;
                $message_to_send = "Please enter valid credentials. ";
            }
            if ($_POST['password'] == $txt[$i + 1]) {
                $passval = true;

            } else {
                $passval = false;
                $message_to_send = "Please enter valid credentials. ";
            }
            $i += 2;
        }

        if (empty($_POST['password']) || empty($_POST['email'])) {
            $message_to_send = "Please enter valid credentials. ";
        } else if ($emailval && $passval) {
            $_SESSION['valid'] = true;
            header("location: index.php");
            die();
        }

    }
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
    <form action="login.php" method="post">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4"><h1>Login to enjoy our Math Game.</h1></div>

        </div>
        <div class="form-horizontal" >
            <div class="form-group">
                <label class="control-label col-sm-2" >Email:</label>
                <div class="col-sm-6">
                    <input type="Email" name="email" class="form-control" placeholder="Email" size="5">
                </div>
            </div>
            <div class="row"></div>
            <div class="form-group">
                <label class="control-label col-sm-2" >Password:</label>
                <div class="col-sm-6">
                    <input type="text" name="password" class="form-control"  placeholder="Password" size="5">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-primary button " value="login">
                    <div id="red"><p><?php echo $message_to_send ?></p></div>
                </div>
			</div>
        </div>
		</form>
</div>

</body>
</html>
