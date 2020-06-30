// Agency Theme JavaScript

(function($) {
    "use strict"; // Start of use strict

    // jQuery for page scrolling feature - requires jQuery Easing plugin
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top - 50)
        }, 1250, 'easeInOutExpo');
        event.preventDefault();
    });

    // Highlight the top nav as scrolling occurs
    $('body').scrollspy({
        target: '.navbar-fixed-top',
        offset: 51
    });

    // Offset for Main Navigation
    $('#mainNav').affix({
        offset: {
            top: 100
        }
    })

})(jQuery); // End of use strict

$(document).ready(function(){
    $('#search-submit').hide();

    $('#main-search').focus(function() {
        $(this).attr('placeholder', 'Enter Parcel PWBLT No.');
        $('#search-submit').fadeIn('slow');
    }).blur(function() {
        $(this).attr('placeholder', 'Track Your Parcel');
        $('#search-submit').fadeOut('slow');
    })
});