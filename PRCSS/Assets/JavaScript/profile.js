var pswmatch = true;

function validate(form){
    var opass = document.getElementById("originalpass").value;
    var cpass = document.getElementById("crpass").value;

    document.getElementById("phone").style.borderColor= "#b8b8b8";
    document.getElementById("phoneerror").innerHTML = "";

    var ck_phone = /^[0-9+]{11,13}$/;

    var phone = document.getElementById("phone").value;

    var errors = [];

    if (phone!= '' && !ck_phone.test(phone)) {
        document.getElementById("phone").style.borderColor= "red";
        document.getElementById("phoneerror").style.color = "red";
        document.getElementById("phoneerror").innerHTML = "Incorrect Phone Number";
        errors[errors.length] = errors.length;
    }

    if(cpass == '' || cpass != opass) {

    }
    else{
        if(pswmatch == false){
            document.getElementById("showmatch").style.color = "red";
            document.getElementById("showmatch").innerHTML = "Password doesnot match";
            errors[errors.length] = errors.length;
        }
    }

    if (errors.length > 0) {
        return false;
    }

    return true;
}

function checkstrength(pass){

    var ln = pass.length;

    if(ln < 6) {
        document.getElementById("npass").style.borderColor= "red";
        document.getElementById("showstrength").style.color = "red";
        document.getElementById("showstrength").innerHTML = "Weak";
    }
    else if(ln >= 6 && ln < 8){
        document.getElementById("npass").style.borderColor= "yellow";
        document.getElementById("showstrength").style.color = "#c6c600";
        document.getElementById("showstrength").innerHTML = "Medium";
    }
    else if(ln >= 8){
        document.getElementById("npass").style.borderColor= "#006622";
        document.getElementById("showstrength").style.color = "#006622";
        document.getElementById("showstrength").innerHTML = "Strong";
    }
}

function matchpass(ncpass){
    var ppass = document.getElementById("npass").value;

    if(ppass == ncpass){
        document.getElementById("cnpass").style.borderColor = "#006622";
        document.getElementById("showmatch").style.color = "#006622";
        document.getElementById("showmatch").innerHTML = "Matched";
        pswmatch = true;
    }
    else{
        document.getElementById("cnpass").style.borderColor = "red";
        document.getElementById("showmatch").innerHTML = "";
        pswmatch = false;
    }

}

function vipeout(){
    document.getElementById("cnpass").value = "";
    document.getElementById("npass").value = "";
    document.getElementById("showstrength").innerHTML = "";
    document.getElementById("showmatch").innerHTML = "";
}

$(document).ready(function(){
    $("#pswpanel").hide();
    $('#upload').fadeOut('slow');
    var cpass = $('#originalpass').val();

    $('#image-process').change(function(){
       var img = $('#image-process').val();
        if(img == 'change') {
            $('#upload').fadeIn('slow');
        }
        else{
            $('#upload').fadeOut('slow');
            $('#fileToUpload').val('');
        }
    });

    $('#crpass').keyup(function() {
        var pass = $('#crpass').val();
        if(cpass == pass){
            $('#npass').removeAttr('disabled');
            $('#cnpass').removeAttr('disabled');
        }
        else{
            $('#npass').attr({'disabled': 'disabled'});
            $('#cnpass').attr({'disabled': 'disabled'});
        }
    });

    $("#pswbtn").click(function(){
        $("#pswpanel").slideToggle("slow");
    });
});