var rot = 0;

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).ready(function(){
    $("#home").mousedown(function(){
        $(this).css({"border" : "3px solid gainsboro"});
    });
    $("#home").mouseup(function(){
        $(this).css({"border":"3px solid #333333"});
    });

    $("#bookacc").mousedown(function(){
        $(this).css({"border" : "3px solid gainsboro"});
    });
    $("#bookacc").mouseup(function(){
        $(this).css({"border":"2px solid #333333"});
    });

    $("#transitacc").mousedown(function(){
        $(this).css({"border" : "3px solid gainsboro"});
    });
    $("#transitacc").mouseup(function(){
        $(this).css({"border":"3px solid #333333"});
    });

    $("#parcellist").mousedown(function(){
        $(this).css({"border" : "3px solid gainsboro"});
    });
    $("#parcellist").mouseup(function(){
        $(this).css({"border":"3px solid #333333"});
    });

    $("#delparcel").mousedown(function(){
        $(this).css({"border" : "3px solid gainsboro"});
    });
    $("#delparcel").mouseup(function(){
        $(this).css({"border":"3px solid #333333"});
    });

    $("#searchofficer").mousedown(function(){
        $(this).css({"border" : "3px solid gainsboro"});
    });
    $("#searchofficer").mouseup(function(){
        $(this).css({"border":"3px solid #333333"});
    });

    $("#changepass").mousedown(function(){
        $(this).css({"border" : "3px solid gainsboro"});
    });
    $("#changepass").mouseup(function(){
        $(this).css({"border":"3px solid #333333"});
    });

    $(document).click(function(event) {
        if(!$(event.target).closest('#parcellist').length) {
            $("#parcellistic").removeClass("rot");
        }
    })

    $("#parcellist").click(function(){
        $("#parcellistic").toggleClass("rot");
    });

});
