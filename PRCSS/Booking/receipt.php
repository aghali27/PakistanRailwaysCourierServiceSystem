<?php
    require("fpdf17/fpdf.php");
    include ("../connection.php");

    $pwblt = $_GET['pid'];

    $sqlreceipt = mysqli_query($con,"SELECT packagedetails.pwblt_No , packagedetails.source , packagedetails.destination , packagedetails.description ,
    packagedetails.total_packages ,packagedetails.weightkg , packagedetails.weightton , packagedetails.value_of_package , packagedetails.risk_form ,
    packagedetails.cash_paid, packagedetails.status , packagedetails.date_booked , packagedetails.time_booked , packagedetails.booking_officer_id ,
    packagedetails.b_officer_name , sender_recieverdetails.package_pwblt_no , sender_recieverdetails.sender_name , sender_recieverdetails.sender_address ,
    sender_recieverdetails.sender_cnic , sender_recieverdetails.sender_phone, sender_recieverdetails.reciever_name , sender_recieverdetails.reciever_address,
    sender_recieverdetails.reciever_cnic, sender_recieverdetails.reciever_phone
    FROM packagedetails JOIN sender_recieverdetails
    ON packagedetails.pwblt_No = '$pwblt' AND packagedetails.pwblt_No = sender_recieverdetails.package_pwblt_no");

    $sqlparcelcount = mysqli_num_rows($sqlreceipt);
    if($sqlparcelcount > 0) {
        while ($prow = mysqli_fetch_array($sqlreceipt)) {
            $pwblt = $prow['pwblt_No'];
            $source = $prow['source'];
            $dest = $prow['destination'];
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
            $boid = $prow['booking_officer_id'];
            $boname = $prow['b_officer_name'];
            $sname = $prow['sender_name'];
            $saddress = $prow['sender_address'];
            $scnic = $prow['sender_cnic'];
            $sphone = $prow['sender_phone'];
            $rname = $prow['reciever_name'];
            $raddress = $prow['reciever_address'];
            $rcnic = $prow['reciever_cnic'];
            $rphone = $prow['reciever_phone'];
        }

        $pdf = new FPDF();

        $pdf->SetAuthor('Waqas Waheed');
        $pdf->SetTitle('Pakistan Railway Courier Booking Services');

        $pdf->AddPage('P');
        $pdf->SetFont("Arial", "B", "20");
        $pdf->Cell(0, 15, 'Pakistan Railways Courier System Services', 0, 1, 'C', 0);

        $pdf->SetFont("Arial", "B", "17");
        $pdf->Cell(0, 10, 'Booking Receipt', 0, 1, 'C', 0);

        $pdf->Cell(0, 110, '', 1, 0, 'C', 0);
        $pdf->Cell(0, 0, '', 0, 1, 'C', 0);

        $pdf->SetFont("Arial", "B", "15");
        $pdf->Cell(0, 10, ' Parcel Details', 0, 1, '', 0);

        $pdf->SetFont("Arial", "", "10");

        $pdf->Cell(130, 10, " PWBLT No  :                                            " . $pwblt . "", 0, 0, '', 0);

        $pdf->Cell(0, 10, " Date/Time :   " . $bdate . "/" . $btime . "", 0, 1, '', 0);

        $pdf->Cell(0, 10, " Parcel Way-Bill Form  :                             " . $source . "", 0, 1, '', 0);

        $pdf->Cell(0, 10, " To  :                                                           " . $dest . "", 0, 1, '', 0);

        $pdf->Cell(130, 10, " Sender Name  :                                         " . $sname . "", 0, 0, '', 0);

        $pdf->Cell(0, 10, " CNIC :          " . $scnic . "", 0, 1, '', 0);

        $pdf->Cell(130, 10, " Consignee Name  :                                    " . $rname . "", 0, 0, '', 0);

        $pdf->Cell(0, 10, " CNIC :          " . $rcnic . "", 0, 1, '', 0);

        $pdf->Cell(0, 10, " No.of Packages  :                                       " . $tpackages . "", 0, 1, '', 0);

        $pdf->Cell(0, 10, " Package Description  :                               " . $desc . "", 0, 1, '', 0);

        $pdf->Cell(0, 10, " Risk Form Attached  :                                 " . $risk . "", 0, 1, '', 0);

        $pdf->Cell(0, 10, " Weight  :                                                     " . $wkg . "kg(s) & " . $wtn . "tonne(s)", 0, 1, '', 0);

        $pdf->Cell(0, 10, " Cash Paid  :                                                " . $cash . "", 0, 1, '', 0);

        $pdf->Cell(0, 10, '', 0, 1, 'C', 0);

        $pdf->Cell(0, 30, '', 1, 0, 'C', 0);
        $pdf->Cell(0, 0, '', 0, 1, 'C', 0);

        $pdf->SetFont("Arial", "B", "15");
        $pdf->Cell(0, 10, ' Booked By', 0, 1, '', 0);

        $pdf->SetFont("Arial", "", "10");

        $pdf->Cell(0, 10, " Officer ID  :                        " . $boid . "", 0, 1, '', 0);

        $pdf->Cell(130, 10, " Officer Name  :                   " . $boname . "", 0, 0, '', 0);

        $pdf->Cell(0, 10, "Signature:________________", 0, 1, '', 0);


        $pdf->Cell(0, 20, '', 0, 1, 'C', 0);

        $pdf->SetFont("Arial", "B", "10");
        $pdf->Cell(0, 10, "To Track Parcel visit 'http://localhost/PRCSS-UserSite/home.php'", 0, 1, 'C', 0);
        $pdf->SetFont("Arial", "B", "17");
        $pdf->Cell(0, 10, "Speed-Come-Safety", 0, 1, 'C', 0);

        $pdf->Output('Receipt.pdf', 'I');

    }else {
        echo "<html>
        <head>
            <link rel='shortcut icon' href='../Assets/icons/favicon.ico' type='image/x-icon'/ >
            <script src='../Assets/JavaScript/jquerygen.js'></script>
            <script type='text/javascript' src='../jquery.backstretch.min.js'></script>
            </head>
        <body>
        <h3 style='color : white; font-family: Segoe UI;'>Parcel Doesn't Exist</h3>
        <a style='font-family: Segoe UI; text-decoration: none ; border: 1px solid white ; background: #006622 ; color: white; font-size: 25px;' href='generatereceipt.php'>OK</a>
        <script type='text/javascript'>
        $.backstretch('../Assets/Images/pakistan.jpg', {speed: 1000});
        </script>
        </body>
        </html>";
    }

?>