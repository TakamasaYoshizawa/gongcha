jQuery(document).ready(function($) {
    $('.slider').slick({
        arrows: true,
        prevArrow: $('.slick-prev'),
        nextArrow: $('.slick-next'),
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
    });
});
