<?php
    include ('connection.php');
    $pid = $_GET['pid'];



    $sqlparcel = mysqli_query($con,"SELECT * FROM packagedetails WHERE pwblt_No='$pid'");
    $sqlsenderreceiver = mysqli_query($con,"SELECT * FROM sender_recieverdetails WHERE package_pwblt_no='$pid'");

    $parcelcount = mysqli_num_rows($sqlparcel);

    while($prow = mysqli_fetch_array($sqlparcel)) {
        $pwblt = $prow['pwblt_No'];
        $from = $prow['source'];
        $to = $prow['destination'];
        $desc = $prow['description'];
        $tpackages = $prow['total_packages'];
        $wkg = $prow['weightkg'];
        $wtn = $prow['weightton'];
        $value = $prow['value_of_package'];
        $risk = $prow['risk_form'];
        $cash = $prow['cash_paid'];
        $status = $prow['status'];
        $bdate = $prow['date_booked'];
        $btime = $prow['time_booked'];
        $ddate = $prow['date_departure'];
        $rdate = $prow['date_recieved'];
        $boid = $prow['booking_officer_id'];
        $boname = $prow['b_officer_name'];
        $godown = $prow['godown_type'];
        $receivedpackages = $prow['recieving_packages'];
    }

    while($rsrow = mysqli_fetch_array($sqlsenderreceiver)) {
        $sname = $rsrow['sender_name'];
        $saddress = $rsrow['sender_address'];
        $scnic = $rsrow['sender_cnic'];
        $sphone = $rsrow['sender_phone'];
        $semail = $rsrow['sender_email'];
        $rname = $rsrow['reciever_name'];
        $raddress = $rsrow['reciever_address'];
        $rcnic = $rsrow['reciever_cnic'];
        $rphone = $rsrow['reciever_phone'];
        $remail = $rsrow['receiver_email'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRCSS - Track Result</title>
    <link rel='shortcut icon' href='img/logos/favicon.ico' type='image/x-icon'/ >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="js/jquerygen.js"></script>
    <script type="text/javascript" src="js/jquery.backstretch.min.js"></script>
    <script src="bootstrap-3.3.6-dist/js/bootstrap.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="bootstrap-3.3.6-dist/css/bootstrap.min.css">
    <link href="css/trackresult.css" rel="stylesheet" type="text/css">
    <script src="js/trackresult.js" type="text/javascript"></script>

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
</head>
<body>
<div id="wrapper" class="container-fluid">
    <div class="row">
        <div id="header">
            <div>
                <div id="content">
                    <h2 onclick="window.location.href='home.php'" id="mainheading">Pakistan Railways</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div id="incontent">
            <div class="searchheading">
                <p id="subheading">Parcel Details</p>
            </div>
            <nav class="nav-style" data-spy="affix" data-offset-top="50">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav nav-tabs nav-justified" role="tablist">
                            <li class="active"><a data-toggle="tab"  href="#currstatus">Current Status</a></li>
                            <li><a data-toggle="tab"  href="#basicinfo">Basic Information</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="tab-content">

                <!------------------------------------------------------ Status ------------------------------------------------------>

                <div id="currstatus" class="tab-pane fade in active">

                    <?php

                    if($parcelcount > 0) {

                        $sqlsending = mysqli_query($con, "SELECT * FROM sending_packages WHERE pwblt_No='" . $pwblt . "' AND sdeleterow = '0'");
                        $sendingcount = mysqli_num_rows($sqlsending);

                        $sqlpending = mysqli_query($con, "SELECT * FROM pending_packages WHERE pwblt_No='$pid' AND transittype!='VSR'");
                        $pendingcount = mysqli_num_rows($sqlpending);

                        if ($status == 'booked') {
                            echo "<section class='tablecontainer curr-status'>";
                            echo "<h3><span class='label label-info'>Booked</span></h3>";
                            echo "<h3 id='subheading1'>Parcel Booked At : " . $from . "</h3>";
                            echo "</div></section>";
                        } elseif ($status == 'received') {
                            echo "<section class='tablecontainer curr-status'>
                            <h3><span class='label label-success label-mini'>Received</span></h3>
                        <h3 id='subheading1'>Parcel Received at Destination</h3>
                        <table id='received' class='table received'>
                            <th>Received Date : " . $rdate . "</th>
                            <th>Parcels in Godown : " . $godown . "</th>
                        </table></section>";
                        } elseif ($status == 'departed') {

                            echo "<section id='no-more-tables' class='tablecontainer curr-status'>
                            <h3><span class='label label-warning'>Departed</span></h3>
                        <table id='received' class='table received'>
                            <h3 id='subheading1'>Received Packages</h3>
                            <tr>
                                <th>Packages Received at Destination : " . $receivedpackages . "</th>
                            </tr>
                        </table>
                        <table id='sending' class='table sending'>
                            <h3 id='subheading1'>Sending Packages</h3>";

                            if ($sendingcount > 0) {

                                echo "<thead>
                            <tr>
                                <th>No. of Packages</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Train No.</th>
                                <th>Date/Time</th>
                                <th>Transit Officer ID</th>
                                <th>Officer Name</th>
                            </tr>
                            </thead>
                            <tbody>";
                                while ($rows = mysqli_fetch_array($sqlsending)) {
                                    $snop = $rows['sno_of_packages'];
                                    $sfrom = $rows['from_station'];
                                    $sto = $rows['to_station'];
                                    $strain = $rows['train_no'];
                                    $stoid = $rows['transitID'];
                                    $stoname = $rows['transitname'];
                                    $sdate = $rows['senddate'];
                                    $stime = $rows['sendtime'];
                                    $scode = $rows['scode'];
                                    $stype = $rows['sendtype'];
                                    $sdeleterow = $rows['sdeleterow'];

                                    if ($stype == 'OC') {
                                        echo "<tr style='color: #ca0009'>
                                    <td data-title='No. of Packages'>" . $snop . "</td>
                                    <td data-title='From'>" . $sfrom . "</td>
                                    <td data-title='To'>OC from : " . $sto . "</td>
                                    <td data-title='Train No.'>" . $strain . "</td>
                                    <td data-title='Date/Time'>" . $sdate . " &nbsp; " . $stime . "</td>
                                    <td data-title='Transit Officer ID'>" . $stoid . "</td>
                                    <td data-title='Officer Name'>" . $stoname . "</td>
                                    <td>Over Carried</td>
                                    </tr>";
                                    } else {
                                        echo "<tr>
                                    <td data-title='No. of Packages'>" . $snop . "</td>
                                    <td data-title='From'>" . $sfrom . "</td>
                                    <td data-title='To'>" . $sto . "</td>
                                    <td data-title='Train No.'>" . $strain . "</td>
                                    <td data-title='Date/Time'>" . $sdate . " &nbsp; " . $stime . "</td>
                                    <td data-title='Transit Officer ID'>" . $stoid . "</td>
                                    <td data-title='Officer Name'>" . $stoname . "</td>
                                    </tr>";
                                    }
                                }
                                echo "</tbody>";
                            } else {
                                echo "<h4>No Packages Sending !!!</h4>";
                            }
                            echo "</table>";
                            echo "<table id='pending' class='table pending'>
                            <h3 id='subheading1'>Pending Packages</h3>";

                            if ($pendingcount > 0) {
                                echo "<thead>
                            <tr>
                                <th>No. of Packages</th>
                                <th>At Station</th>
                            </tr>
                            </thead>
                            <tbody>";
                                while ($prow = mysqli_fetch_array($sqlpending)) {
                                    $pendingat = $prow['from_st'];
                                    $pendingnop = $prow['no_of_packages'];
                                    echo "<tr>
                                <td data-title='Packages Pending'>" . $pendingnop . "</td>
                                <td data-title='At Station'>" . $pendingat . "</td>
                                </tr>";
                                }
                                echo "</tbody>";
                            } else {
                                echo "<h4>No Pending Packages !!!</h4>";
                            }
                            echo "</table>
                    </section>";

                        }
                    }else{
                        echo "<h3 id='subheading1'>Parcel Dosen't Exist!</h3>";
                    }
                ?>
                </div>

                <!------------------------------------------------------ Info ------------------------------------------------------>

                <div id="basicinfo" class="tab-pane fade">

                    <?php

                    if($parcelcount > 0) {

                        echo "<div class='tablecontainer'>
                        <table class='table'>
                            <tr>
                                <th>PWBLT No:</th>
                                <td colspan='2'>" . $pid . "</td>
                            </tr>
                            <tr>
                                <th>Status:</th>";
                        if ($status == 'booked') {
                            $ddate = '-';
                            $rdate = '-';
                            echo "<td colspan='2'><span class='label label-info label-mini'>Booked</span></td>";
                        } elseif ($status == 'departed') {
                            $rdate = '-';
                            echo "<td colspan='2'><span class='label label-warning label-mini'>Departed</span></td>";
                        } elseif ($status == 'received') {
                            echo "<td colspan='2'><span class='label label-success label-mini'>Received</span></td>";
                        }
                        echo "</tr>
                            <tr>
                                <th>Booked Date / Time:</th>
                                <td colspan='2'>" . $bdate . " / " . $btime . "</td>
                            </tr>
                            <tr>
                                <th>Departed Date:</th>
                                <td colspan='2'>" . $ddate . "</td>
                            </tr>
                            <tr>
                                <th>Received Date:</th>
                                <td colspan='2'>" . $rdate . "</td>
                            </tr>
                            <tr>
                                <th>From:</th>
                                <td colspan='2'>" . $from . "</td>
                            </tr>
                            <tr>
                                <th>To:</th>
                                <td colspan='2'>" . $to . "</td>
                            </tr>
                            <tr>
                                <th>Description:</th>
                                <td colspan='2'>" . $desc . "</td>
                            </tr>
                            <tr>
                                <th>Packages:</th>
                                <td colspan='2'>" . $tpackages . "</td>
                            </tr>
                            <tr>
                                <th>Weight:</th>
                                <td>" . $wkg . " kg(s)</td><td>" . $wtn . " tonne(s)</td>
                            </tr>
                            <tr>
                                <th>Value of Package:</th>
                                <td colspan='2'>" . $value . "</td>
                            </tr>
                            <tr>
                                <th>Risk Form Attached:</th>
                                <td colspan='2'>" . $risk . "</td>
                            </tr>
                            <tr>
                                <th>Cash Paid:</th>
                                <td colspan='2'>" . $cash . "</td>
                            </tr>
                            <tr>
                                <th style='font-size : 25px' class='th-col' colspan='3'>Sender Details</th>
                            </tr>
                            <tr>
                                <th>Name :</th>
                                <td colspan='2'>" . $sname . "</td>
                            </tr>
                            <tr>
                                <th>CNIC :</th>
                                <td colspan='2'>" . $scnic . "</td>
                            </tr>
                            <tr>
                                <th>Address :</th>
                                <td colspan='2'>" . $saddress . "</td>
                            </tr>
                            <tr>
                                <th>Phone :</th>
                                <td colspan='2'>" . $sphone . "</td>
                            </tr>
                            <tr>
                                <th>Email :</th>
                                <td colspan='2'>" . $semail . "</td>
                            </tr>
                            <tr>
                                <th style='font-size : 25px' class='th-col' colspan='3'>Receiver Details</th>
                            </tr>
                            <tr>
                                <th>Name :</th>
                                <td colspan='2'>" . $rname . "</td>
                            </tr>
                            <tr>
                                <th>CNIC :</th>
                                <td colspan='2'>" . $rcnic . "</td>
                            </tr>
                            <tr>
                                <th>Address :</th>
                                <td colspan='2'>" . $raddress . "</td>
                            </tr>
                            <tr>
                                <th>Phone :</th>
                                <td colspan='2'>" . $rphone . "</td>
                            </tr>
                            <tr>
                                <th>Email :</th>
                                <td colspan='2'>" . $remail . "</td>
                            </tr>
                            <tr>
                                <th style='font-size : 25px' class='th-col' colspan='3'>Sended By</th>
                            </tr>
                            <tr>
                                <th>Booking Officer(ID) :</th>
                                <td colspan='2'>" . $boid . "</td>
                            </tr>
                            <tr>
                                <th>Officer Name :</th>
                                <td colspan='2'>" . $boname . "</td>
                            </tr>
                        </table>
                    </div>

                </div>";
                    }else{
                        echo "<h3 id='subheading1'>Parcel Dosen't Exist</h3>";
                    }
            ?>

            </div>


            <footer id="footer">
                <p id="fp">Copyright &copy; PRCSS 2016</p>
            </footer>
        </div>
    </div>
</div>
</body>
<script type="text/javascript">
    $.backstretch("img/header-bg.jpg", {speed: 1000});
</script>
</html>