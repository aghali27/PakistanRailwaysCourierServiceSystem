var rot = 0;

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).ready(function(){
    $("#home").mousedown(function(){
        $(this).css({"border" : "3px solid gainsboro"});
    });
    $("#home").mouseup(function(){
        $(this).css({"border":"3px solid #006622"});
    });

    $("#bookParcel").mousedown(function(){
        $(this).css({"border" : "3px solid gainsboro"});
    });
    $("#bookParcel").mouseup(function(){
        $(this).css({"border":"2px solid #006622"});
    });

    $("#receipt").mousedown(function(){
        $(this).css({"border" : "3px solid gainsboro"});
    });
    $("#receipt").mouseup(function(){
        $(this).css({"border":"3px solid #006622"});
    });

    $("#list").mousedown(function(){
        $(this).css({"border" : "3px solid gainsboro"});
    });
    $("#list").mouseup(function(){
        $(this).css({"border":"3px solid #006622"});
    });

    $("#search").mousedown(function(){
        $(this).css({"border" : "3px solid gainsboro"});
    });
    $("#search").mouseup(function(){
        $(this).css({"border":"3px solid #006622"});
    });

    $("#profile").mousedown(function(){
        $(this).css({"border" : "3px solid gainsboro"});
    });
    $("#profile").mouseup(function(){
        $(this).css({"border":"3px solid #006622"});
    });

    $(document).click(function(event) {
        if(!$(event.target).closest('#list').length) {
            $("#vpic").removeClass("rot");
        }
    })

    $("#list").click(function(){
        $("#vpic").toggleClass("rot");
    });
});
