var nav = false;
var height = $(window).height();

function changeFunction(x){
    x.classList.toggle("change");
    if(nav == false)
        openNav();
    else
        closeNav();
}

function openNav(){
    nav = true;
    document.getElementById("mySidenav").classList.add("sidenavchange");
    document.getElementById("incontent").classList.add("incontentchange");
    document.getElementById("footer").classList.add("footerchange");
}

function closeNav(){
    nav = false;
    document.getElementById("mySidenav").classList.remove("sidenavchange");
    document.getElementById("incontent").classList.remove("incontentchange");
    document.getElementById("footer").classList.remove("footerchange");
}

$(document).ready(function(){
    $("#parcelmenu").hide();
    $("#profilemenu").hide();
    $("#viewparcel").click(function(){
        $("#viewtext").css({"text-decoration" : "none"});
        $("#profilemenu").slideUp("slow");
        $("#parcelmenu").slideToggle("slow");
    });
    $("#userprofile").click(function(){
        $("#profiletext").css({"text-decoration" : "none"});
        $("#parcelmenu").slideUp("slow");
        $("#profilemenu").slideToggle("slow");
    });
});
$(document).ready(function(){
    $('a.back-to-top').click(function() {
        $('html, body').animate({
            scrollTop: 0
        }, 700);
        return false;
    });
});
