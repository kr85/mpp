(function ($) {

    //$(document).ready(function() {

        var url = $(location).attr('href');

        if (url == "http://mpp.dev/") {
            // Hide navbar
            $(".navbar").hide();

            $(function() {
                $(window).scroll(function() {
                    if ($(this).scrollTop() > 800) {
                        $('.navbar').fadeIn();
                    } else {
                        $('.navbar').fadeOut();
                    }
                });
            });
        }

        /*$(function() {
            $.vegas({
                src: 'bower_components/libs/vegas/images/intro.png'
            });
            $.vegas('overlay', {
                src: 'bower_components/libs/vegas/overlays/6.png'
            });
        });*/
    //});
}(jQuery));