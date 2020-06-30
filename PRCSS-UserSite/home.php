<?php
include ("connection.php");
$sqlstation = mysqli_query($con,"SELECT st_desc FROM pr_station");

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PRCSS - Parcel Tracking</title>

    <!-- Bootstrap Core CSS -->
    <link href="bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel='shortcut icon' href='img/logos/favicon.ico' type='image/x-icon'/ >

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Theme CSS -->
    <link href="css/home.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]-->
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <script>

        function getmessage() {

            nm = document.getElementById("name").value;
            city = document.getElementById("city").value;
            pid = document.getElementById("pwbltno").value;
            msg = document.getElementById("message").value;


            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("name").value = "";
                    document.getElementById("city").value = "";
                    document.getElementById("pwbltno").value = "";
                    document.getElementById("message").value = "";
                    document.getElementById("modelcontent").innerHTML = xmlhttp.responseText;
                }
            };
            xmlhttp.open("GET","feedback.php?name="+nm+"&city="+city+"&pid="+pid+"&msg="+msg,true);
            xmlhttp.send();
        }
    </script>

</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">Pakistan Railways</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">Services</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#feedback">Feedback</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
                <center><img src="img/logos/PNGlogo.png"></center>
                <div class="intro-lead-in">Pakistan Railways Courier System Services</div>
                <div class="intro-heading">Speed-Come-Safety</div>
                <form class="search-form" method="get" action="trackresult.php">
                    <input type="text" name="pid" id="main-search" class="page-scroll searchbar" placeholder="Track Your Parcel" required><br>
                    <input type="submit" id="search-submit" class="track-btn" value="TRACK">
                </form>
            </div>
        </div>
    </header>

    <!-- Services Section -->
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Services</h2>
                    <h3 class="section-subheading text-muted">Quality is a trait that we appreciate.</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-shopping-cart fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Transport Service</h4>
                    <p class="text-muted">Passenger traffic comprises 50% of the total revenue annually. During 1999-2000, this amounted to Rs. 4.8 billion. Pakistan Railways carries 65 million passengers annually and daily operates 228 mail, express and passenger trains. Daily, the railway carries an average of 178,000 people. Pakistan Railways also operates special trains during occasions such as Eid ul Fitr, Eid ul Azha, Independence Day and Raiwind Ijtema.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-laptop fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Courier Services</h4>
                    <p class="text-muted">Pakistan Railways Courier Service delivers messages, packages and mail. It was developed to offer a faster and more secure alternative to the usual mail service that had been the only delivery service for so long.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-lock fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Freight Services</h4>
                    <p class="text-muted">The Freight Business Unit, with 12,000 personnel, operates over 200 freight stations on the railway network. The unit serves the Ports of Karachi and Bin Qasim as well as all four provinces of the country and generates revenue from the movement of agricultural, industrial and imported products such as petroleum oil & lubricants, wheat, coal, fertilizer, rock phosphate, cement and sugar. About 39% of the revenue is generated from the transportation of POL products, 19% from imported wheat, fertilizer and rock phosphate. The remaining 42% is earned from domestic traffic. The Freight Business Unit is headed by an additional General Manager.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Grid Section -->


    <!-- About Section -->
    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">About Us</h2>
                    <h3 class="section-subheading text-muted">History of Pakistan Railways</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="timeline">
                        <li>
                            <div class="timeline-image">
                                <img class="img-circle img-responsive" src="img/about/1.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>1850-1947</h4>
                                    <h4 class="subheading">Our Beginnings</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">In 1947 when Pakistan was created, 8,122 route kilometers (5,048 mi) of railway were transferred to Pakistan. Of this 6,880 route kilometers (4,280 mi) were 1,676 mm (5 ft 6 in), 506 kilometres (314 mi) were 1,000 mm (3 ft 3 3⁄8 in), and 736 kilometres (457 mi) were 2 ft 6 in (762 mm) narrow gauge.</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <img class="img-circle img-responsive" src="img/about/2.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>1950-1965</h4>
                                    <h4 class="subheading">Getting on foot</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">From 1950-55, the Mashriq-Maghreb Express (Train number 5214) operated from Taftan in West Pakistan to Chittagong in East Pakistan, using Indian railway track and rolling stock for a 1986 km (1245 m) journey between Attari and Benapole. In 1954, the railway line was extended to Mardan and Charsada, and in 1956 the Jacobabad-Kashmore 2 ft 6 in (762 mm) gauge line was converted into 1,676 mm (5 ft 6 in).</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-image">
                                <img class="img-circle img-responsive" src="img/about/3.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>1970-2000</h4>
                                    <h4 class="subheading">Transition to Full Service</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">In 1974, the North Western Railways was renamed Pakistan Railways. The Kot Adu-Kashmore line was constructed between 1969 and 1973 providing an alternative route from Karachi to northern Pakistan.</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <img class="img-circle img-responsive" src="img/about/4.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>After 2000</h4>
                                    <h4 class="subheading">Making Improvements</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted"> In February 2006 the Mirpur Khas-Khokhrapar 126 km metre gauge railway line was converted to Indian gauge. On 8 January 2016 Lodhran-Raiwind double rail track completed and open for traffic.</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <h4>Success
                                    <br>is Our
                                    <br>Destiny!</h4>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->

    <!-- Clients Aside -->

    <!-- Contact Section -->
    <section id="feedback">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Your Feedback</h2>
                    <h3 class="section-subheading text-muted">Your suggestion matters to us</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form name="sentMessage">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input name="name" type="text" class="form-control" placeholder="Your Name" id="name" required data-validation-required-message="Please enter your name.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input name="city" list="stations" class="form-control" placeholder="Station" id="city" required data-validation-required-message="Please enter your email address.">
                                    <p class="help-block text-danger"></p>
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
                                <div class="form-group">
                                    <input name="pid" type="text" class="form-control" placeholder="Your Parcel No. " id="pwbltno" required>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea name="message" class="form-control" placeholder="Your Message... " id="message" required data-validation-required-message="Please enter a message."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <div class="btn btn-xl" data-toggle='modal' data-target="#myModel" onclick="getmessage()">Send Message</div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="myModel" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div id="modelcontent" class="modal-content">

            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <span class="copyright">Copyright &copy; PRCSS 2016</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Portfolio Modals -->
    <!-- Use the modals below to showcase details about your portfolio projects! -->



    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="js/jquerygen.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/home.js"></script>

</body>

</html>
