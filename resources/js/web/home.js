import LazyLoad from "vanilla-lazyload";
import Swal from 'sweetalert2';
window.Swal = Swal;
import 'owl.carousel/dist/assets/owl.carousel.css';
import 'owl.carousel';

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

$('.swiper-wrapper').owlCarousel({
    loop: false,
    rewind: true,
    dots:true,
    nav:false,
    margin: 30,
    responsiveClass:true,
    responsive:{
        0:{
            items:2,
            nav:false
        },
        600:{
            items:2,
            nav:false
        },
        1000:{
            items:3,
            nav:false,
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
            nav:false
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:5,
            nav:false,
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
            nav:false
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:5,
            nav:false,
            loop:false
        }
    }
});
