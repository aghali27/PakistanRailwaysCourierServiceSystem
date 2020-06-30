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
$altpath2 = "../Assets/Images/default.gif";

$sqlprofile = mysqli_query($con,"SELECT * FROM employeelogin WHERE id = '$id'");
while($urow = mysqli_fetch_array($sqlprofile)){
    $domain = $urow['udomain'];
    $name = $urow['uname'];
    $cnic = $urow['cnic'];
    $phone = $urow['phone'];
    $email = $urow['email'];
    $wstation = $urow['workingstation'];
    $pass = $urow['password'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="../Assets/JavaScript/jquerygen.js"></script>
    <script src="../bootstrap-3.3.6-dist/js/bootstrap.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../bootstrap-3.3.6-dist/css/bootstrap.min.css">
    <link href="../Assets/CSS/shared.css" rel="stylesheet" type="text/css">
    <link href="../Assets/CSS/profile.css" rel="stylesheet" type="text/css">
    <script src="../Assets/JavaScript/shared.js" type="text/javascript"></script>
    <script src="../Assets/JavaScript/profile.js" type="text/javascript"></script>
</head>
<body>
<div id="wrapper" class="container-fluid">
    <div class="row">
        <div id="header">
            <div>
                <a data-toggle="tooltip" title="View Menu">
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
            <div class="searchheading">
                <p id="subheading">User Profile</p>
            </div>
            <nav id="affix1" class="nav-style">
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
                            <li class='active'><a data-toggle='tab'  href='#view'>View</a></li>
                            <li><a data-toggle='tab'  href='#edit'>Edit</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="tab-content">

                <div id="view" class="tab-pane fade in active">

                    <div class="profileview-container">
                        <div class="img-circle img-right">
                            <img src="<?php if($image != null)  echo $image; else echo $altpath2; ?>">
                        </div>
                        <div class="details-container">
                            <table class="table table-striped">
                                <tr>
                                    <center><img src="<?php if($image != null)  echo $image; else echo $altpath2; ?>"></center>
                                </tr>
                                <tr>
                                    <th>User ID:</th>
                                    <td><?php echo $id; ?></td>
                                </tr>
                                <tr>
                                    <th>Name:</th>
                                    <td><?php echo $name; ?></td>
                                </tr>
                                <tr>
                                    <th>CNIC:</th>
                                    <td><?php echo $cnic; ?></td>
                                </tr>
                                <tr>
                                    <th>Phone:</th>
                                    <td><?php echo $phone; ?></td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td><?php echo $email; ?></td>
                                </tr>
                                <tr>
                                    <th>Working Station:</th>
                                    <td><?php echo $wstation; ?></td>
                                </tr>
                                <tr>
                                    <th>Working Domain:</th>
                                    <td><?php echo $domain; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>

                <div id="edit" class="tab-pane fade">

                    <div class="container-fluid userprofile">
                        <form class="container-fluid" onSubmit="return validate(this);" action="updatingprofile.php" method="post" enctype="multipart/form-data">
                            <div class="form-inline form-group">
                                <label id="seclbl" class="control-label">User ID: </label>
                                <input type="text" class="form-control" id="formlenght" name="uid" value="<?php echo $id; ?>" readonly>
                            </div>
                            <hr>
                            <div class="form-inline form-group">
                                <label id="seclbl" class="control-label">Name: </label>
                                <input type="text" class="form-control" id="formlenght" name="uname" value="<?php echo $name; ?>" readonly>
                            </div>
                            <hr>
                            <div class="form-inline form-group">
                                <label id="seclbl" class="control-label">Phone: </label>
                                <input type="number" class="form-control" id="phone" name="uphone" value="<?php echo $phone; ?>">
                            </div>
                            <div id="phoneerror" class="infobars"></div>
                            <hr>
                            <div class="form-inline form-group">
                                <label id="seclbl" class="control-label">Email: </label>
                                <input type="email" class="form-control" id="formlenght" value="<?php echo $email; ?>" name="uemail" required>
                            </div>
                            <hr>
                            <div class="form-inline form-group">
                                <label id="seclbl" class="control-label">Change/Remove Image: </label>
                                <input type="hidden" name="oldimage" value="<?php echo $image; ?>">
                                <select id="image-process" name="image-action" class="form-control">
                                    <option value="none">None</option>
                                    <option value="remove">Remove Image</option>
                                    <option value="change">Change Image</option>
                                </select>
                            </div>
                            <div id="upload" class="form-inline form-group">
                                <label id="seclbl" class="control-label">Upload Image: </label>
                                <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
                            </div>
                            <hr>
                            <div id="pswbtn" class="chngpsw">Change Password</div>
                            <div id="pswpanel" class="pswpanel">
                                <div class="form-inline form-group">
                                    <label id="seclbl" class="control-label">Current Password: </label>
                                    <input type="hidden" id="originalpass" name="originalpass" value="<?php echo $pass; ?>">
                                    <input type="password" class="form-control" name="currentpass" id="crpass" onkeyup="vipeout()">
                                </div>
                                <hr>
                                <div class="form-inline form-group">
                                    <label id="seclbl" class="control-label">New Password: </label>
                                    <input type="password" name="newpass" class="form-control" id="npass" onkeyup="checkstrength(this.value)" disabled>
                                </div>
                                <div id="showstrength" class="infobars"></div>
                                <hr>
                                <div class="form-inline form-group">
                                    <label id="seclbl" class="control-label">Confirm Password: </label>
                                    <input type="password" name="confirmpass" class="form-control" id="cnpass" onkeyup="matchpass(this.value)" disabled>
                                </div>
                                <div id="showmatch" class="infobars"></div>
                            </div>
                            <hr>
                            <input type="hidden" name="cnic" value="<?php echo $cnic; ?>">
                            <button type="submit" class="editprof">Save Changes</button>
                        </form>
                    </div>

                </div>

            </div>


            <div id="footer">
                <p id="fp">PRCSS Booking Services<a href="#" class="back-to-top"><span class="glyphicon glyphicon-chevron-up" id="fb"></span></a></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>