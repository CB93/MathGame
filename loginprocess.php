<?php
session_start();
extract($_POST);


if (empty($password)) {
    $msg ="Invalid login credentials!";
    header("location: login.php?msg=$msg");
    } else {
    header("location: index.php");
    }


?>
<?php include("include/footer.php"); ?>