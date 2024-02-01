import 'mmenu-js';
document.addEventListener('DOMContentLoaded', () => {
    new Mmenu("#navigation-menu", {
        classes: 'mm-white mm-slide',
        searchfield: false,
        counters: false,
        header: false,
        }, {});
});

$(document).ready(function() {
    // var fixmeTop = $('.navbar-finalstyle').offset().top;
    // console.log(fixmeTop);
    // $(window).scroll(function() {
    //     var currentScroll = $(window).scrollTop();
    //     if (currentScroll >= 30) {
    //         $('.navbar-finalstyle').addClass('active-menu');
    //     } else {
    //         $('.navbar-finalstyle').removeClass('active-menu');
    //     }
    // });
    // $('nav#navigation-menu').mmenu({
    //     classes: 'mm-white mm-slide',
    //     searchfield: false,
    //     counters: false,
    //     header: false,
    // });
    setTimeout(function () {
        $('#fs-popup-home').modal('show');
    }, 7000);
});
$(window).on('scroll', function(event) {
    if ($(this).scrollTop() > 100) {
        $('.backgr-menu').addClass('fixed-top');
    } else {
        $('.backgr-menu').removeClass('fixed-top');
    }
});
