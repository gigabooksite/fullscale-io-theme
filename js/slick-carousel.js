jQuery(document).ready(function($) {
    $('.tech-talents.minimal > div').slick({
        mobileFirst: true,
        adaptiveHeight: true,
        responsive: [
            {
                breakpoint: 768,
                settings: "unslick"
            },
            {
                breakpoint: 480,
                adaptiveHeight: true,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            }
        ]
    });
});