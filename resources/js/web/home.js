require('../bootstrap');
import $ from "jquery";
window.$ = $;
import 'bootstrap';
import swal from 'sweetalert2';
window.Swal = swal;
import 'owl.carousel';
import LazyLoad from "vanilla-lazyload";
require('./main');

var lazyLoadInstance = new LazyLoad({
    // Your custom settings go here
});
$("#owl-demo").owlCarousel({
    autoplay: true, //Set AutoPlay to 3 seconds
    autoplaySpeed: 500,
    autoHeight: true,
    loop: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    items: 1,
    lazyLoad: true,
    nav: false,
    dots: true,
    responsive: {
        0: {
            autoplay: false
        },
        480: {
            autoplay: false
        },
        768: {
            autoplay: true
        }
    }
});

setTimeout(() => {
    var carouselData = $("#owl-demo").data();
    var carouselOptions = carouselData['owl.carousel'].options;
    carouselOptions.autoplayTimeout = 6000;
    $("#owl-demo").trigger('refresh.owl.carousel');
}, 1000);

$('.swiper-wrapper').owlCarousel({
    loop: false,
    rewind: true,
    dots:true,
    nav:false,
    responsiveClass:true,
    responsive:{
        0:{
            items:2,
            nav:true
        },
        600:{
            items:2,
            nav:false
        },
        1000:{
            items:3,
            nav:true,
            loop:false
        }
    }
});

$('.sider-slick-add').owlCarousel({
    loop: false,
    rewind: true,
    dots:false,
    responsiveClass:true,
    responsive:{
        0:{
            items:2,
            nav:true
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:5,
            nav:true,
            loop:false
        }
    }
});

$('.sun-group').owlCarousel({
    loop: false,
    rewind: true,
    dots:false,
    responsiveClass:true,
    responsive:{
        0:{
            items:2,
            nav:true
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:5,
            nav:true,
            loop:false
        }
    }
});

$('.list-contract').owlCarousel({
    loop: false,
    rewind: true,
    dots:false,
    responsiveClass:true,
    responsive:{
        0:{
            items:2,
            nav:true
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:5,
            nav:true,
            loop:false
        }
    }
});

