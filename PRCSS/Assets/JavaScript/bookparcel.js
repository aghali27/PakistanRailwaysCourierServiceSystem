function validate(){

    document.getElementById("sname").style.borderColor= "#b8b8b8";
    document.getElementById("snameerror").innerHTML = "";
    document.getElementById("scnic").style.borderColor= "#b8b8b8";
    document.getElementById("scnicerror").innerHTML = "";
    document.getElementById("sphone").style.borderColor= "#b8b8b8";
    document.getElementById("sphoneerror").innerHTML = "";
    document.getElementById("rname").style.borderColor= "#b8b8b8";
    document.getElementById("rnameerror").innerHTML = "";
    document.getElementById("rcnic").style.borderColor= "#b8b8b8";
    document.getElementById("rcnicerror").innerHTML = "";
    document.getElementById("rphone").style.borderColor= "#b8b8b8";
    document.getElementById("rphoneerror").innerHTML = "";

    var ck_name = /^[A-Za-z ]{3,20}$/;
    var ck_cnic = /^[0-9]{13,13}$/;
    var ck_phone = /^[0-9+]{11,13}$/;

    var sname = document.getElementById("sname").value;
    var scnic = document.getElementById("scnic").value;
    var sphone = document.getElementById("sphone").value;

    var rname = document.getElementById("rname").value;
    var rcnic = document.getElementById("rcnic").value;
    var rphone = document.getElementById("rphone").value;


    var errors = [];

    if (!ck_name.test(sname)) {
        document.getElementById("sname").style.borderColor= "red";
        document.getElementById("snameerror").style.color = "red";
        document.getElementById("snameerror").innerHTML = "Incorrect name format";
        errors[errors.length] = errors.length;
    }
    if (!ck_cnic.test(scnic)) {
        document.getElementById("scnic").style.borderColor= "red";
        document.getElementById("scnicerror").style.color = "red";
        document.getElementById("scnicerror").innerHTML = "Incorrect CNIC";
        errors[errors.length] = errors.length;
    }
    if (sphone!= '' && !ck_phone.test(sphone)) {
        document.getElementById("sphone").style.borderColor= "red";
        document.getElementById("sphoneerror").style.color = "red";
        document.getElementById("sphoneerror").innerHTML = "Incorrect Phone Number";
        errors[errors.length] = errors.length;
    }

    if (!ck_name.test(rname)) {
        document.getElementById("rname").style.borderColor= "red";
        document.getElementById("rnameerror").style.color = "red";
        document.getElementById("rnameerror").innerHTML = "Incorrect name format";
        errors[errors.length] = errors.length;
    }
    if (!ck_cnic.test(rcnic)) {
        document.getElementById("rcnic").style.borderColor= "red";
        document.getElementById("rcnicerror").style.color = "red";
        document.getElementById("rcnicerror").innerHTML = "Incorrect CNIC";
        errors[errors.length] = errors.length;
    }
    if (rphone!= '' && !ck_phone.test(rphone)) {
        document.getElementById("rphone").style.borderColor= "red";
        document.getElementById("rphoneerror").style.color = "red";
        document.getElementById("rphoneerror").innerHTML = "Incorrect Phone Number";
        errors[errors.length] = errors.length;
    }

    if (errors.length > 0) {
        return false;
    }

    return true;
}

function getDetails() {

    var bid = document.getElementById("boid").value;
    var bids = bid.toString();
    var kg = document.getElementById("wkg").value;
    var kgs = kg.toString();
    var tn = document.getElementById("wtn").value;
    var tns = tn.toString();
    var vp = document.getElementById("pvalue").value;
    var vps = vp.toString();
    var np = document.getElementById("pnumber").value;
    var nps = np.toString();
    var cp = document.getElementById("cash").value;
    var cps = cp.toString();
    var sc = document.getElementById("scnic").value;
    var scs = sc.toString();
    var sp = document.getElementById("sphone").value;
    var sps = sp.toString();
    var rc = document.getElementById("rcnic").value;
    var rcs = rc.toString();
    var rp = document.getElementById("rphone").value;
    var rps = rp.toString();

    var pn = document.getElementById("pid").value;
    var fs = document.getElementById("fst").value;
    var ts = document.getElementById("tst").value;
    var ds = document.getElementById("des").value;
    var rs = document.getElementById("risktype").value;
    var sn = document.getElementById("sname").value;
    var sa = document.getElementById("saddress").value;
    var se = document.getElementById("semail").value;
    var rn = document.getElementById("rname").value;
    var ra = document.getElementById("raddress").value;
    var re = document.getElementById("remail").value;

    document.getElementById('bid').innerHTML = bids;
    document.getElementById('pn').innerHTML = pn;
    document.getElementById('fs').innerHTML = fs;
    document.getElementById('ts').innerHTML = ts;
    document.getElementById('ds').innerHTML = ds;
    document.getElementById('kg').innerHTML = kgs;
    document.getElementById('tn').innerHTML = tns;
    document.getElementById('vp').innerHTML = vps;
    document.getElementById('np').innerHTML = nps;
    document.getElementById('cp').innerHTML = cps;
    document.getElementById('rs').innerHTML = rs;
    document.getElementById('sn').innerHTML = sn;
    document.getElementById('sa').innerHTML = sa;
    document.getElementById('sc').innerHTML = scs;
    document.getElementById('sp').innerHTML = sps;
    document.getElementById('ses').innerHTML = se;
    document.getElementById('rn').innerHTML = rn;
    document.getElementById('ra').innerHTML = ra;
    document.getElementById('rc').innerHTML = rcs;
    document.getElementById('rp').innerHTML = rps;
    document.getElementById('res').innerHTML = re;
}

$(document).ready(function(){
    // Add scrollspy to <body>
    $('body').scrollspy({target: ".navbar", offset: 113});

    // Add smooth scrolling on all links inside the navbar
    $("#myNavbar a").on('click', function(event) {
        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
            // Prevent default anchor click behavior
            event.preventDefault();

            // Store hash
            var hash = this.hash;

            // Using jQuery's animate() method to add smooth page scroll
            // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 900, function(){

                // Add hash (#) to URL when done scrolling (default click behavior)
                window.location.hash = hash;
            });
        }  // End if
    });

});

$(document).ready(function(){
    $("#boid,#bdate,#pid,#fst,#tst,#des,#wkg,#wtn,#pvalue,#pnumber,#cash,#risk,#riskpanel,#risktype").focus(function(){
        $("#sec1").css("border", "2px solid #006622");
    });
    $("#boid,#bdate,#pid,#fst,#tst,#des,#wkg,#wtn,#pvalue,#pnumber,#cash,#risk,#riskpanel,#risktype").blur(function(){
        $("#sec1").css("border", "2px solid white");
    });
    $("#sname,#saddress,#scnic,#sphone,#semail").focus(function(){
        $("#sec2").css("border", "2px solid #006622");
    })
    $("#sname,#saddress,#scnic,#sphone,#semail").blur(function(){
        $("#sec2").css("border", "2px solid white");
    })
    $("#rname,#raddress,#rcnic,#rphone,#remail").focus(function(){
        $("#sec3").css("border", "2px solid #006622");
    })
    $("#rname,#raddress,#rcnic,#rphone,#remail").blur(function(){
        $("#sec3").css("border", "2px solid white");
    })
});

$(document).ready(function()
{
    function conversionkg()
    {
        var kg = parseFloat($("#wkg").val());
        var ton = kg / 1000;
        $("#wtn").val(ton);
    }
    function conversionton()
    {
        var ton = parseFloat($("#wtn").val());
        var kg = ton * 1000;
        $("#wkg").val(kg);
    }
    $(document).on("change, keyup", "#wkg", conversionkg);
    $(document).on("change, keyup", "#wtn", conversionton);
});

$(document).ready(function(){

    function risktype(){
        cash = parseInt($("#cash").val());
        if(riskcheck == true && attcheck == true) {
            if (cash <= 10000) {
                var a = "A";
                $("#risktype").val(a);
            }
            else if (cash > 10000) {
                var x = "X";
                $("#risktype").val(x);
            }
            else {
                var n = "None";
                $("#risktype").val(n);
            }
        }
    }
    $(document).on("change, keyup", "#cash", risktype);
    $("#riskpanel").hide();
    $("#risk").click(function(){
        riskcheck = true;
        $("#sec1").css("border", "2px solid #006622");
        $("#riskpanel").slideDown("slow");
    });
    $("#attach").click(function(){
        attcheck = true;
        risktype();
        $("#sec1").css("border", "2px solid white");
        $("#riskpanel").slideUp("slow");
    });
    $("#cancel").click(function(){
        attcheck = false;
        $("#risktype").val("None");
        $("#sec1").css("border", "2px solid white");
        $("#riskpanel").slideUp("slow");
    });

    $("#proceed").click(function(){
       if(validate()){
           $('#myModal').modal('show');
       }
        else{
           $('#myModal').modal('hide');
       }
    });
});
