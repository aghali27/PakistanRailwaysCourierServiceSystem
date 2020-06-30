<?php
include ("../connection.php");
session_start();
if(!isset($_SESSION['id'])) {
    header("location:../Login.php");
}else {
    if($_SESSION['domain'] == "transit"){
        header("location:../Transit/Transit.php");
    }
}

$id = $_SESSION['id'];
$uname = $_SESSION['name'];
$udomain = $_SESSION['domain'];
$station = $_SESSION['station'];
$image = $_SESSION['img'];
$altpath = "../Assets/Icons/UserFilled.png";

$sqlstation = mysqli_query($con,"SELECT st_desc FROM pr_station WHERE st_desc!='$station'");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='shortcut icon' href='../Assets/icons/favicon.ico' type='image/x-icon'/ >
    <title>Book Parcel</title>
    <script src="../Assets/JavaScript/jquerygen.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="../Assets/JavaScript/jquerygen.js"></script>
    <script src="../bootstrap-3.3.6-dist/js/bootstrap.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../bootstrap-3.3.6-dist/css/bootstrap.min.css">
    <link href="../Assets/CSS/shared.css" rel="stylesheet" type="text/css">
    <link href="../Assets/CSS/bookparcel.css" rel="stylesheet" type="text/css">
    <script src="../Assets/JavaScript/shared.js" type="text/javascript"></script>
    <script src="../Assets/JavaScript/bookparcel.js" type="text/javascript"></script>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="0">
<div id="wrapper" class="container-fluid">
    <div class="row">
        <div id="header">
            <div>
                <a style="cursor: pointer" title="View Menu">
                    <div id="menubtn" onclick="changeFunction(this)">
                        <div class="bar1"></div>
                        <div class="bar2"></div>
                        <div class="bar3"></div>
                    </div>
                </a>
                <div id="logoutbtn">
                    <button class="btn1" onclick="window.location.href='../logout.php'">Logout</button>
                </div>
                <div id="content">
                    <h2 id="mainheading">PAKISTAN RAILWAYS</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div id="mySidenav" class="sidenav">
            <div id="profiledisplay">

                <a><img src="<?php if($image != null)  echo $image; else echo $altpath; ?>" width = 100 height = 100></a>
                <h4 class="profile"><?php echo $uname?></h4>
                <h4 class="profile"><?php echo $station?></h4>
            </div>
            <ul class="sidenavcontent">
                <li class="list"><a href="Booking.php"><span class="glyphicon glyphicon-home"></span>     Home</a></li><br><br>
                <li class="list"><a href="bookparcel.php"><span class="glyphicon glyphicon-list"></span>     Book Parcel</a></li><br><br>
                <li class="list"><a href="generatereceipt.php"><span class="glyphicon glyphicon-list-alt"></span>     Generate Reciept</a></li><br><br>
                <li class="list" id="viewlist"><div id="viewparcel"><a style="cursor: pointer" id ="viewtext"><span class="glyphicon glyphicon-eye-open"></span>     View Parcels</a></div>
                    <div id="parcelmenu"><ul><br>
                            <li class="list"><a href="parcellist.php?type=all">View All</a></li>
                            <li class="list"><a href="parcellist.php?type=booked">Booked Parcels</a></li>
                            <li class="list"><a href="parcellist.php?type=departed">Departed Parcels</a></li>
                            <li class="list"><a href="parcellist.php?type=received">Received Parcels</a></li>
                        </ul></div>
                </li><br><br>
                <li class="list"><a href="bsearchparcel.php"><span class="glyphicon glyphicon-search"></span>     Search Parcels</a></li><br><br>
                <li class="list"><a href="bookingprofile.php"><span class="glyphicon glyphicon-user"></span>     User Profile</a></li><br><br>
            </ul>
        </div>
        <div id="incontent">

            <div class="container-fluid" style="background-color:#333333;color:#fff;height:70px;">
                <h1 id="subheading">Parcel Forwarding Form</h1><br>
            </div>

            <nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="70">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div>
                        <div class="collapse navbar-collapse" id="myNavbar">
                            <ul class="nav navbar-nav">
                                <li><a href="#section1" class="navbtns">Parcel's Detail</a></li>
                                <li><a href="#section2" class="navbtns">Sender's Detail</a></li>
                                <li><a href="#section3" class="navbtns">Consignee's Detail</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <form autocomplete="off" class="form-horizontal" action="bookingprocess.php" method="post" onsubmit="return validate();">
                <div id="section1" class="container-fluid" >
                    <h2 class="secheadings">Parcel Details</h2>
                    <h3 class="secheadings">This section contains information about "The Parcel"</h3>
                    <div class="container-fluid" id="sec1">
                        <div class="form-inline form-group">
                            <label id="seclbl" class="control-label">Booking Officer ID: </label>
                            <input type="text" class="form-control" id="boid" name="boid" value="<?php echo $id; ?>" readonly>
                        </div>
                        <input type="hidden" name="boname" value="<?php echo $uname; ?>">
                        <hr>
                        <div class="form-inline form-group">
                            <label id="seclbl" class="control-label">PWBLT No.: </label>
                            <input type="text" class="form-control" id="pid" name="pid" autofocus required>
                        </div>
                        <hr>
                        <div class="form-inline form-group">
                            <label id="seclbl" class="control-label">From Station: </label>
                            <input type="text" class="form-control" id="fst" name="fst" value="<?php echo $station; ?>" readonly>
                        </div>
                        <hr>
                        <div class="form-inline form-group">
                            <label id="seclbl" class="control-label">To Station: </label>
                            <input list="stations" class="form-control" id="tst" name="tst" required>
                            <?php
                            // Datalist For Stations //

                            echo "<datalist id='stations' >";
                            while($row = mysqli_fetch_array($sqlstation)){
                                $name = $row["st_desc"];
                                echo "<option value='".$name."'>";

                            }
                            echo "</datalist>";
                            ?>
                        </div>
                        <hr>
                        <div class="form-inline form-group">
                            <label id="seclbl" class="control-label">Description of contents: </label>
                            <textarea rows="3" class="form-control" id="des" name="des" required></textarea>
                        </div>
                        <hr>
                        <div class="form-inline form-group">
                            <label id="seclbl" class="control-label">Weight </label>
                            <input type="number" class="form-control" id="wkg" name="wkg" step="any" min="0" required>
                            <label id="lkg" class="control-label">Kg(s) </label>
                            <input type="number" class="form-control" id="wtn" name="wtn" step="any" required>
                            <label id="ltn" class="control-label">Tonne(s) </label>
                        </div>
                        <hr>
                        <div class="form-inline form-group">
                            <label id="seclbl" class="control-label">Value of Package: </label>
                            <input type="number" class="form-control" id="pvalue" name="pvalue" min="0" required>
                        </div>
                        <hr>
                        <div class="form-inline form-group">
                            <label id="seclbl" class="control-label">No. of Packages: </label>
                            <input type="number" class="form-control" id="pnumber" name="pnumber" min="1" required>
                        </div>
                        <hr>
                        <div class="form-inline form-group">
                            <label id="seclbl" class="control-label">Cash Paid: </label>
                            <input type="number" class="form-control" id="cash" name="cash" min="0" required>
                        </div>
                        <hr>
                        <div class="btn btn-danger" id="risk">Apply for Risk Form</div>
                        <div id="riskpanel">
                            <p>If Cash Amount is Less than 10000 then Risk Note Form "A" will be attached</p>
                            <p>If Cash Amount is Greater than 10000 then Risk Note Form "X" will be attached</p>
                            <div class="btn-group-justified">
                                <div id="attach" class="btn btn-primary">Attach Form</div>
                                <div id="cancel" class="btn btn-danger">Cancel</div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-inline form-group">
                            <label id="seclbl" class="control-label">Risk Form Attached: </label>
                            <input type="text" class="form-control" id="risktype" name="risktype" value="None" readonly>
                        </div>
                        <hr>
                    </div>
                </div>
                <div id="section2" class="container-fluid">
                    <h2 class="secheadings">Sender Details</h2>
                    <h3 class="secheadings">This section contains information about "The Sender of Parcel"</h3>
                    <div class="container-fluid" id="sec2">
                        <div class="form-inline form-group">
                            <label id="seclbl" class="control-label">Name: </label>
                            <input type="text" class="form-control" id="sname" name="sname" required>
                        </div>
                        <div id="snameerror" class="infobars"></div>
                        <hr>
                        <div class="form-inline form-group">
                            <label id="seclbl" class="control-label">Address: </label>
                            <textarea rows="3" class="form-control" id="saddress" name="saddress" required></textarea>
                        </div>
                        <hr>
                        <div class="form-inline form-group">
                            <label id="seclbl" class="control-label">CNIC: </label>
                            <input type="number" class="form-control" id="scnic" name="scnic" required>
                        </div>
                        <div id="scnicerror" class="infobars"></div>
                        <hr>
                        <div class="form-inline form-group">
                            <label id="seclbl" class="control-label">Phone: </label>
                            <input type="number" class="form-control" id="sphone" name="sphone" required>
                        </div>
                        <div id="sphoneerror" class="infobars"></div>
                        <hr>
                        <div class="form-inline form-group">
                            <label id="seclbl" class="control-label">Email: </label>
                            <input type="email" class="form-control" id="semail" name="semail">
                        </div>
                        <hr>
                    </div>
                </div>
                <div id="section3" class="container-fluid">
                    <h2 class="secheadings">Consignee Details</h2>
                    <h3 class="secheadings">This section contains information about "The Receiver of Parcel"</h3>
                    <div class="container-fluid" id="sec3">
                        <div class="form-inline form-group">
                            <label id="seclbl" class="control-label">Name: </label>
                            <input type="text" class="form-control" id="rname" name="rname" required>
                        </div>
                        <div id="rnameerror" class="infobars"></div>
                        <hr>
                        <div class="form-inline form-group">
                            <label id="seclbl" class="control-label">Address: </label>
                            <textarea rows="3" class="form-control" id="raddress" name="raddress" required></textarea>
                        </div>
                        <hr>
                        <div class="form-inline form-group">
                            <label id="seclbl" class="control-label">CNIC: </label>
                            <input type="number" class="form-control" id="rcnic" name="rcnic" required>
                        </div>
                        <div id="rcnicerror" class="infobars"></div>
                        <hr>
                        <div class="form-inline form-group">
                            <label id="seclbl" class="control-label">Phone: </label>
                            <input type="number" class="form-control" id="rphone" name="rphone" required>
                        </div>
                        <div id="rphoneerror" class="infobars"></div>
                        <hr>
                        <div class="form-inline form-group">
                            <label id="seclbl" class="control-label">Email: </label>
                            <input type="email" class="form-control" id="remail" name="remail">
                        </div>
                        <hr>
                    </div>
                    <div id="proceed" type="button" class="btn btn-info btn-lg" onclick="getDetails()">Submit</div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog modal-lg">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3 class="modal-title">Details Confirmation</h3>
                            </div>
                            <div class="modal-body">
                                <h4 class="modal-subheading">Parcel Details</h4>
                                <table class="table table-striped" >
                                    <tr>
                                        <th>Booking Officer ID:</th>
                                        <td id="bid"></td>
                                    </tr>
                                    <tr>
                                        <th>PWBLT No:</th>
                                        <td id="pn"></td>
                                    </tr>
                                    <tr>
                                        <th>From Station:</th>
                                        <td id="fs"></td>
                                    </tr>
                                    <tr>
                                        <th>To Station:</th>
                                        <td id="ts"></td>
                                    </tr>
                                    <tr>
                                        <th>Description of Contents:</th>
                                        <td id="ds"></td>
                                    </tr>
                                    <tr>
                                        <th>Weight in Kg(s):</th>
                                        <td id="kg"></td>
                                    </tr>
                                    <tr>
                                        <th>Weight in Tonne(s):</th>
                                        <td id="tn"></td>
                                    </tr>
                                    <tr>
                                        <th>Value of Package:</th>
                                        <td id="vp"></td>
                                    </tr>
                                    <tr>
                                        <th>No. of Package:</th>
                                        <td id="np"></td>
                                    </tr>
                                    <tr>
                                        <th>Cash Paid:</th>
                                        <td id="cp"></td>
                                    </tr>
                                    <tr>
                                        <th>Risk Form Attached:</th>
                                        <td id="rs"></td>
                                    </tr>
                                    <tr>
                                        <th><h4 class="modal-subheading">Sender Details</h4></th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Name:</th>
                                        <td id="sn"></td>
                                    </tr>
                                    <tr>
                                        <th>Address:</th>
                                        <td id="sa"></td>
                                    </tr>
                                    <tr>
                                        <th>CNIC:</th>
                                        <td id="sc"></td>
                                    </tr>
                                    <tr>
                                        <th>Phone:</th>
                                        <td id="sp"></td>
                                    </tr>
                                    <tr>
                                        <th>Email:</th>
                                        <td id="ses"></td>
                                    </tr>
                                    <tr>
                                        <th><h4 class="modal-subheading">Reciever Details</h4></th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Name:</th>
                                        <td id="rn"></td>
                                    </tr>
                                    <tr>
                                        <th>Address:</th>
                                        <td id="ra"></td>
                                    </tr>
                                    <tr>
                                        <th>CNIC:</th>
                                        <td id="rc"></td>
                                    </tr>
                                    <tr>
                                        <th>Phone:</th>
                                        <td id="rp"></td>
                                    </tr>
                                    <tr>
                                        <th>Email:</th>
                                        <td id="res"></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-success" value="Book Parcel" style="border-radius: 0;width: 100%;margin-left: 5px;font-weight: bold">
                                <button type="button" class="btn btn-warning" data-dismiss="modal" style="border-radius: 0;width: 100%;font-weight: bold;margin-top: 5px">Edit Form</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div id="footer">
                <p id="fp">PRCSS Booking Services<a href="#" class="back-to-top"><span class="glyphicon glyphicon-chevron-up" id="fb"></span></a></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>