$(document).ready(function () {
  var $w = $(window);
  var $d = $(document);
  var $b = $("body");

  if ($(".woocommerce-ordering select").length) {
    $(".woocommerce-ordering select").select2({
      minimumResultsForSearch: -1,
    });
  }

  if($(".search-form input[type=search]").length) {
    $(".search-form input[type=search]").prop("maxLength", 50);
  }


  $d.on("click", ".js-wc-cart", function () {
    $(".mini-cart").toggleClass("d-block");
  });

  var toggle = false;
  var $menu = $(".js-menu");
  var $responsiveMenu = $(".responsive-menu");
  var $toggler = $(".toggler");

  //   RESPONSIVE MENU BTN CLICK TO OPEN MENU
  $menu.on("click", function () {
    toggle = !toggle;

    if (toggle) {
      $responsiveMenu.addClass("open");
      $toggler.addClass("open");
    } else {
      $responsiveMenu.removeClass("open");
      $toggler.removeClass("open");
    }
  });

  // search on mobile/tablet
  var $searchMobile = $(".js-search-mobile");
  var $searchAreaInput = $(".js-search-area input[type='search']");

  $searchAreaInput.focusout(function () {
    $(this).closest(".js-search-area").addClass("d-none");
  });

  $searchMobile.focus(function () {
    $(this).next(".search-area").removeClass("d-none").focus();

    $(".search-area input[type='search']").focus();
  });

  if ($(".mega-width-auto").length) {
    $(".mega-width-auto").each(function () {
      if ($w.width() >= 1100) {
        $(this)
          .find("> ul.mega-sub-menu")
          .css(
            "margin-left",
            $(this).offset().left -
              24 -
              $("#mega-menu-wrap-header #mega-menu-header").offset().left +
              "px"
          );
      }
    });
  }

  $w.resize(function () {
    if ($(".mega-width-auto").length) {
      $(".mega-width-auto").each(function () {
        if ($w.width() >= 1100) {
          $(this)
            .find("> ul.mega-sub-menu")
            .css(
              "margin-left",
              $(this).offset().left -
                24 -
                $("#mega-menu-wrap-header #mega-menu-header").offset().left -
                +"px"
            );
        } else {
          if ($(this).find("> ul.mega-sub-menu").css("margin-left")) {
            $(this).find("> ul.mega-sub-menu").css("margin-left", 0);
          }
        }
      });
    }
  });

});

document.addEventListener("DOMContentLoaded", function(){
  let divc = document.querySelectorAll('div[style]');
  for (let i = 0, len = divc.length; i < len; i++) {
    let actdisplay = window.getComputedStyle(divc[i], null).display;
    let actclear = window.getComputedStyle(divc[i], null).clear;

    if(actdisplay == 'block' && actclear == 'both') {
      divc[i].remove();
}
  }
    });
