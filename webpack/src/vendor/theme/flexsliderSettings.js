$(document).ready(function () {
  if ($(".taxonomy-flexslider").length) {
    $(".taxonomy-flexslider").flexslider({
      animation: "slide",
      controlNav: "thumbnails",
      prevText: "",
      nextText: "",
      animationLoop: false,
    });
  }

  // store the slider in a local variable
  var $window = $(window),
    flexslider = { vars: {} };

  // tiny helper function to add breakpoints
  function getItemSize() {
    return window.innerWidth >= 1100 ? 88 : 54;
  }

  function getItemMargin() {
    return window.innerWidth >= 1100 ? 14.4 : 8;
  }

  if ($("#slider").length) {
    $("#carousel").flexslider({
      animation: "slide",
      controlNav: false,
      animationLoop: false,
      slideshow: false,
      itemWidth: getItemSize(),
      itemMargin: getItemMargin(),
      asNavFor: "#slider",
      prevText: "",
      nextText: "",
      start: function (slider) {
        flexslider = slider;
      },
    });

    $("#slider").flexslider({
      animation: "slide",
      controlNav: false,
      animationLoop: false,
      slideshow: false,
      sync: "#carousel",
      prevText: "",
      nextText: "",
    });
    // check grid size on resize event
    $window.resize(function () {
      var itemSize = getItemSize();
      var itemMargin = getItemMargin();

      flexslider.vars.itemWidth = itemSize;
      flexslider.vars.itemMargin = itemMargin;
    });

    $('[data-fancybox="images"]').fancybox({
      clickContent: false,
      infobar: false,
      thumbs: {
        autoStart: true,
        axis: "x",
      },
      buttons: ["close"],
      tpl: {
        closeBtn:
          '<a title="Close" class="fancybox-item fancybox-close myClose" href="javascript:;"></a>',
      },
      
      btnTpl: {
        arrowLeft:
          '<button data-fancybox-prev class="fancybox-button fancybox-button--arrow_left d-flex justify-content-center align-items-center" title="{{PREV}}">' +
          '<div class="arrow-prev">' +
          "</button>",

        arrowRight:
          '<button data-fancybox-next class="fancybox-button fancybox-button--arrow_right d-flex justify-content-center align-items-center" title="{{NEXT}}">' +
          '<div class="arrow-next">' +
          "</button>",
      },
    });
  }
});
