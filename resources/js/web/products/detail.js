import 'owl.carousel/dist/assets/owl.carousel.css';
import 'owl.carousel';

$('.sider-slick-add').owlCarousel({
    loop: false,
    rewind: true,
    dots:false,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
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
