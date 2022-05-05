$(document).ready(function () {
  if ($(".site-description-slider").length) {
    $(".site-description-slider").on("init", function (event, slick) {
      $('.site-description').attr("style", "")
    });
    $(".site-description-slider").slick({
      dots: false,
      infinite: true,
      speed: 500,
      autoplay: true,
      autoplaySpeed: 5000,
      fade: true,
      cssEase: "linear",
      prevArrow: false,
      nextArrow: false,
    });
  }
});
