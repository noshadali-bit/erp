// Loader

jQuery(document).ready(function () {
  setTimeout(function () {
    jQuery("#preloader").addClass('remove');
  }, 1000);
});

// Top To Button

jQuery(document).ready(function () {
  var toggleHeight = jQuery(window).outerHeight();

  jQuery(window).scroll(function () {
    if (jQuery(window).scrollTop() > toggleHeight) {
      jQuery(".m-backtotop").addClass("active");
      jQuery('h1 span').text('TA-DA! Now hover it and hit dat!');
    } else {
      jQuery(".m-backtotop").removeClass("active");
      jQuery('h1 span').text('(start scrolling)');
    }
  });

  jQuery(".m-backtotop").click(function () {
    jQuery("html, body").animate({ scrollTop: 0 }, "slow");
    return false;
  });
});

// Slider Testimonials

jQuery(".testi-slider").slick({
  dots: false,
  infinite: true,
  arrows: true,
  prevArrow: '<div class="slick-prev"><button type="button"><i class="fas fa-arrow-left"></i></button></div>',
  nextArrow: '<div class="slick-next"><button type="button"><i class="fas fa-arrow-right"></i></button></div>',
  autoplay: false,
  autoplaySpeed: 1500,
  slidesToShow: 3,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1200,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 576,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: false,
      }
    }

  ]
});

// AOS

setTimeout(AOS.init, 100);
AOS.init({
  mobile: false,
  once: true,
});
window.addEventListener('load', AOS.refresh);

// RESPONSIVE MENU OPEN

jQuery('.open-menu').click(function(){
	jQuery('.responsive-menu').addClass('active');
	jQuery('body').addClass('scroll-stop');
});

jQuery('.menu-close').click(function(){
	jQuery('.responsive-menu').removeClass('active');
	jQuery('body').removeClass('scroll-stop');
});
