<html>
<head>
    <link rel='shortcut icon' href='img/logos/favicon.ico' type='image/x-icon'/ >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="js/jquerygen.js"></script>
    <script type="text/javascript" src="js/jquery.backstretch.min.js"></script>
    <script src="bootstrap-3.3.6-dist/js/bootstrap.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="bootstrap-3.3.6-dist/css/bootstrap.min.css">
    <link href="css/home.css" rel="stylesheet">
</head>
<body>
<?php
include ("connection.php");

$name = $_GET['name'];
$city = $_GET['city'];
$pid = $_GET['pid'];
$message = $_GET['msg'];

$datefb = date("Y-m-d");

if($name == "" || $city == "" || $pid == "" || $message == ""){
    echo "<div class='modal-header'>
              <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                <h3 class='modal-title'>All Feilds are Required !</h3>
                            </div>
                            <div class='modal-footer'>
                                <center>
                                    <div class='btn btn-danger' data-dismiss='modal' style='border-radius: 0;width: 100%;font-weight: bold'>Close</div>
                                </center>
                            </div>";
} else {

    $sqlfeedback = mysqli_query($con, "INSERT INTO feedback (cname , city , fbdate , pid , message) VALUES ('$name' , '$city' , '$datefb' , '$pid' , '$message')");

    if ($sqlfeedback) {
        //echo "<h1 style='color: white ; font-family: Segoe UI;'>Thanks for your Feedback</h1>";
        //echo "<a style='font-family: Segoe UI; background: #006622 ; border: 1px solid white ; font-size: 25px ; color: white; text-decoration: none' href='home.php'>HOME</a>";
        echo "<div class='modal-header'>
              <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                <h3 class='modal-title'>THANKS FOR YOUR FEEDBACK!</h3>
                            </div>
                            <div class='modal-footer'>
                                <center>
                                    <div class='btn btn-danger' data-dismiss='modal' style='border-radius: 0;width: 100%;font-weight: bold'>Close</div>
                                </center>
                            </div>";

    }
}
?>
<script type="text/javascript">
    $.backstretch("img/header-bg.jpg", {speed: 1000});
</script>
</body>
</html>
