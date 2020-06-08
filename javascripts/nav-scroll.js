$(document).ready(function() {

    $("#scrolled").hide();
    $(function() {

        $(window).scroll(function() {
//                    if ($(this).scrollTop() > 30) {
//                        $('#head').fadeOut();
//                    } else {
//                        $('#head').fadeIn();
//                        
//                    }
            if ($(this).scrollTop() > 80) {
                $("#scrolled").fadeIn();
            } else {
                $("#scrolled").fadeOut();
                
            }
        });
    });

});