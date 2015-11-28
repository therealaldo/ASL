jQuery(document).ready(function($) {
    
    $(window).scroll(function() {
        // checking distance scrolled from top
        var offset = $(window).scrollTop();

        // change the background of the nav after an offset of 115px
        if (offset >= 115) {
            $("nav.navbar.navbar-default.navbar-fixed-top").css({
                "background":"rgba(44, 62, 80, .96)",
            });
        } else{
            $("nav.navbar.navbar-default.navbar-fixed-top").css({
                "background":"transparent",
            });
        }
    });
});
