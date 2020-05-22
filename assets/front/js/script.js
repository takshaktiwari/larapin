if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/serviceworker.js', {
        scope: '/'
    }).then(function (registration) {
        // Registration was successful
        console.log('Laravel PWA: ServiceWorker registration successful with scope: ', registration.scope);
    }, function (err) {
        // registration failed :(
        console.log('Laravel PWA: ServiceWorker registration failed: ', err);
    });
}

let deferredPrompt;
var buttonWrapper = document.querySelector("#installAppWrapper");
var button = document.querySelector(".installAppBtn");

window.addEventListener('beforeinstallprompt', (e) => {
    // Prevent Chrome 67 and earlier from automatically showing the prompt

    e.preventDefault();
    // Stash the event so it can be triggered later.
    deferredPrompt = e;

    buttonWrapper.classList.toggle('d-none', false);

    button.addEventListener('click', (e) => {
        // Show the prompt
        deferredPrompt.prompt();
        // Wait for the user to respond to the prompt
        deferredPrompt.userChoice
          .then((choiceResult) => {
            if (choiceResult.outcome === 'accepted') {
              console.log('User accepted the A2HS prompt');
            } else {
              console.log('User dismissed the A2HS prompt');
            }
            deferredPrompt = null;
        });
    });
});




    

$(".custom_alert").animate(
        {top: "100px", opacity: "1"}, 
        800,
        'swing',
        function(){
            setTimeout( function(){ 
                $(".custom_alert").animate({left: "0px", opacity: "0"}, 800);
            }, 3500 );
        }
    );



(function($) {
    "use strict";
    $(document).ready(function() {
        function menuHeight() {
            var menuHeight = $('.main-header').innerHeight();
            $('.main-header + section').css('margin-top', menuHeight);
        }
        menuHeight();
        if ($('.main-menu > ul').length) {
            $('.main-menu > ul').append('<button><i class="flaticon-cross"></i></button>');
        }
        if ($('.main-menu .dropdown > ul').length) {
            $('.main-menu .dropdown > ul').after('<div class="dropdown-btn"><span class="fas fa-plus"></span></div>');
        }
        $(".main-menu .dropdown-btn").on('click', function() {
            $(this).prev('ul').slideToggle();
        });
        $(".main-menu > button").on('click', function() {
            $('.main-menu').addClass('open-menu');
            $('.menu-overlay').fadeIn();
        });
        $(".main-menu ul > button").on('click', function() {
            $('.main-menu').removeClass('open-menu');
            $('.menu-overlay').fadeOut();
        });
        $(".menu-overlay").on('click', function() {
            $('.main-menu').removeClass('open-menu');
            $(this).fadeOut();
        });
        $(".categories button").on('click', function() {
            $('.categories ul').slideToggle(300);
            $('.collection-close').show();
        });
        $(".collection-item i").on('click', function() {
            $(this).next('.collection-inner').toggle();
            $('.collection-close').show();
        });
        $(".collection-close").on('click', function() {
            $('.collection-inner').hide();
            $('.collection-close').hide();
            $('.categories ul').slideUp(300);
        });
        if ($('.hero-slider').length) {
            $('.hero-slider').slick({
                dots: true,
                infinite: true,
                autoplay: true,
                arrows: false,
                pauseOnHover: false,
                autoplaySpeed: 2000,
                slidesToShow: 1,
                slidesToScroll: 1,
            });
        }
        if ($('.special-offer-slider').length) {
            $('.special-offer-slider').slick({
                infinite: true,
                arrows: true,
                prevArrow: '<button class="center-array-prev"><i class="fas fa-angle-left"></i></button>',
                nextArrow: '<button class="center-array-next"><i class="fas fa-angle-right"></i></button>',
                pauseOnHover: false,
                autoplay: 2000,
                slidesToShow: 4,
                slidesToScroll: 1,
                responsive: [{
                    breakpoint: 1600,
                    settings: {
                        slidesToShow: 3
                    }
                }, {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 2
                    }
                }, {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2
                    }
                }, {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1
                    }
                }]
            });
        }
        if ($('.shop-items').length) {
            /*$('.shop-items').simpleLoadMore({
                item: '.product',
                count: 12,
                itemsToLoad: 10,
                btnHTML: '<div class="blog-btn text-center w-100 mt-25 mb-30"><a href="blog.html" class="theme-btn br-30">Show More</a></div>'
            });*/
        }
        if ($('.scroll-to-target').length) {
            $(".scroll-to-target").on('click', function() {
                var target = $(this).attr('data-target');
                $('html, body').animate({
                    scrollTop: $(target).offset().top
                }, 1000);
            });
        }
        $(".minus").on('click', function() {
            this.parentNode.querySelector('input[type=number]').stepDown();
        });
        $(".plus").on('click', function() {
            this.parentNode.querySelector('input[type=number]').stepUp();
        });

/*        function priceTotaling() {
            var quantity = $(this).parent().find('input[type=number]').val();
            var price = $(this).parent().parent().find('.product-price').text();
            $(this).parent().parent().find('.product-total-price').text(quantity * price);
            var subTotal = 0;
            $('.product-total-price').each(function() {
                var singleVal = $(this).text();
                if ($.isNumeric(singleVal)) {
                    subTotal += parseFloat(singleVal);
                }
            });
            $('.sub-total .price').text(subTotal);
            var shipping = $('.shipping .price').text();
            var discount = $('.discount .price').text();
            $('.total .price').text((+subTotal) + (+shipping) - discount);
        }
        $(".cart-single-item .close").on('click', function() {
            $(this).parent().fadeOut(500, function() {
                $(this).remove();
                priceTotaling();
            });
        });
        $(".number-input button").on('click', priceTotaling);
        $(".number-input").on('input', '.quantity', priceTotaling);*/
        $(".add-wishlist").on('click', function() {
            $(this).toggleClass('wish');
        });
        if ($('.wow').length) {
            var wow = new WOW({
                boxClass: 'wow',
                animateClass: 'animated',
                offset: 0,
                mobile: false,
                live: true
            });
            wow.init();
        }
    });
    $(window).on('resize', function() {
        function menuHeight() {
            var menuHeight = $('.main-header').innerHeight();
            $('.main-header + section').css('margin-top', menuHeight);
        }
        menuHeight();
    });
    $(window).on('scroll', function() {});
    $(window).on('load', function() {
        function handlePreloader() {
            if ($('.preloader').length) {
                $('.preloader').delay(200).fadeOut(500);
            }
        }
        handlePreloader();
    });
})(window.jQuery);