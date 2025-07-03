// var swiper = new Swiper(".mySwiper", {
//   loop: true,
//   spaceBetween: 10,
//   slidesPerView: 4,
//   freeMode: true,
//   watchSlidesProgress: true,
// });
// var swiper2 = new Swiper(".mySwiper2", {
//   loop: true,
//   spaceBetween: 10,
//   navigation: {
//     nextEl: ".swiper-button-next",
//     prevEl: ".swiper-button-prev",
//   },
//   thumbs: {
//     swiper: swiper,
//   },
// });
///loader////
$(document).ready(function () {
  setTimeout(function () {
    $("#preloader").addClass("remove");
  }, 1000);
});
///// responcive-menu/////
jQuery(".div-nav-bar-icon a").click(function () {
  jQuery(".responsive-menu").addClass("active");
});
jQuery(".menu-close").click(function () {
  jQuery(".responsive-menu").removeClass("active");
});

jQuery(".banner-slider").slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: false,
  asNavFor: ".technology-slider",
  responsive: [
    {
      breakpoint: 1200,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        dots: false,
      },
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
      },
    },
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ],
});

jQuery(".technology-slider").slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  asNavFor: ".banner-slider",
  dots: false,
  centerMode: true,
  centerPadding: "0px",
  focusOnSelect: true,
  arrows: false,
  responsive: [
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        dots: false,
      },
    },
    {
      breakpoint: 577,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
      },
    },
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ],
});
