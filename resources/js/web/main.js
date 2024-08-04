import $ from 'jquery';
import Mmenu from 'mmenu-js';
import '@popperjs/core';
import 'bootstrap';
window.$ = $;
window.Mmenu = Mmenu;
import Swal from 'sweetalert2';
window.Swal = Swal;

$(window).on('scroll', function(event) {
    if ($(this).scrollTop() > 100) {
        $('.backgr-menu').addClass('fixed-top');
    } else {
        $('.backgr-menu').removeClass('fixed-top');
    }
});
