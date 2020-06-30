(function ($) {
    $.fn.floatLabels = function (options) {

        // Settings
        var self = this;
        var settings = $.extend({}, options);


        // Event Handlers
        function registerEventHandlers() {
            self.on('input keyup change', 'input, textarea', function () {
                actions.swapLabels(this);
            });
        }


        // Actions
        var actions = {
            initialize: function() {
                self.each(function () {
                    var $this = $(this);
                    var $label = $this.children('label');
                    var $field = $this.find('input').first();

                    if ($this.children().first().is('label')) {
                        $this.children().first().remove();
                        $this.append($label);
                    }

                    var placeholderText = ($field.attr('placeholder') && $field.attr('placeholder') != $label.text()) ? $field.attr('placeholder') : $label.text();

                    $label.data('placeholder-text', placeholderText);
                    $label.data('original-text', $label.text());

                    if ($field.val() == '') {
                        $field.addClass('empty')
                    }
                });
            },
            swapLabels: function (field) {
                var $field = $(field);
                var $label = $(field).siblings('label').first();
                var isEmpty = Boolean($field.val());

                if (isEmpty) {
                    $field.removeClass('empty');
                    $label.text($label.data('original-text'));
                }
                else {
                    $field.addClass('empty');
                    $label.text($label.data('placeholder-text'));
                }
            }
        }


        // Initialization
        function init() {
            registerEventHandlers();

            actions.initialize();
            self.each(function () {
                actions.swapLabels($(this).find('input,textarea').first());
            });
        }
        init();


        return this;
    };

    $(function () {
        $('.float-label-control').floatLabels();
    });
})(jQuery);

var cniccheck = true;
var pswmatch = false;

function validate(form){

    document.getElementById("name").style.borderColor= "#006622";
    document.getElementById("nameerror").innerHTML = "";
    document.getElementById("cnic").style.borderColor= "#006622";
    document.getElementById("cnicerror").innerHTML = "";
    document.getElementById("phone").style.borderColor= "#006622";
    document.getElementById("phoneerror").innerHTML = "";

    /* Regular Expressions */

    var ck_name = /^[A-Za-z ]{3,20}$/;
    var ck_cnic = /^[0-9]{13,13}$/;
    var ck_phone = /^[0-9+]{11,13}$/;

    var uname = form.uname.value;
    var cnic = form.cnic.value;
    var phone = form.phone.value;


    var errors = [];

    if (!ck_name.test(uname)) {
        document.getElementById("name").style.borderColor= "red";
        document.getElementById("nameerror").style.color = "red";
        document.getElementById("nameerror").innerHTML = "Incorrect name format";
        errors[errors.length] = errors.length;
    }
    if (!ck_cnic.test(cnic)) {
        document.getElementById("cnic").style.borderColor= "red";
        document.getElementById("cnicerror").style.color = "red";
        document.getElementById("cnicerror").innerHTML = "Incorrect CNIC";
        errors[errors.length] = errors.length;
    }
    if (phone!= '' && !ck_phone.test(phone)) {
        document.getElementById("phone").style.borderColor= "red";
        document.getElementById("phoneerror").style.color = "red";
        document.getElementById("phoneerror").innerHTML = "Incorrect Phone Number";
        errors[errors.length] = errors.length;
    }
    if(pswmatch == false){
        document.getElementById("showmatch").style.color = "red";
        document.getElementById("showmatch").innerHTML = "Password doesn't match";
        errors[errors.length] = errors.length
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