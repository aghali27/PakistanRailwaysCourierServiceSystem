<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedbacks</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="../Assets/JavaScript/jquerygen.js"></script>
    <script src="../bootstrap-3.3.6-dist/js/bootstrap.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../bootstrap-3.3.6-dist/css/bootstrap.min.css">
    <link href="../Assets/CSS/feedback.css" rel="stylesheet" type="text/css">
    <script src="../Assets/JavaScript/feedback.js" type="text/javascript"></script>
</head>
<body>

<?php


    echo "<div class='modal-header'>
              <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                <h3 class='modal-title'>Feedback</h3>
                            </div>
                            <div class='modal-body'>
                                <table class='table'>
                                    <tr>
                                        <th>Customer Name:</th>
                                        <td>".$_GET['name']."</td>
                                    </tr>
                                    <tr>
                                        <th>Date:</th>
                                        <td>".$_GET['date']."</td>
                                    </tr>
                                    <tr>
                                        <th>Station:</th>
                                        <td>".$_GET['city']."</td>
                                    </tr>
                                    <tr>
                                        <th>PWBLT No:</th>
                                        <td>".$_GET['pid']."</td>
                                    </tr>
                                    <tr>
                                        <th>Message:</th>
                                        <td>".$_GET['msg']."</td>
                                    </tr>
                                </table>
                            </div>
                            <div class='modal-footer'>
                                <center>
                                    <div class='btn btn-danger' data-dismiss='modal' style='border-radius: 0;width: 100%;font-weight: bold'>Close</div>
                                </center>
                            </div>";

?>

</body>
</html>
