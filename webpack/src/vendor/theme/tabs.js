$(document).ready(function () {
  if ($(".taxonomy .tax-tab").length) {
    $(".taxonomy .tax-tab").on("click", function () {
      if ($(".taxonomy .tax-tab").hasClass("active")) {
        $(".taxonomy .tax-tab").removeClass("active");
      }
      $(this).addClass("active");
      $(".taxonomy .taxonomy-tab-contents .taxonomy-tab-content").css(
        "display",
        "none"
      );

      $(
        ".taxonomy .taxonomy-tab-contents .taxonomy-tab-content#" +
          $(this).attr("tab_content")
      ).css("display", "block");
    });
  }

  $('.taxonomy-tab-contents table').each(function() {
    if($(this).find("tr:nth-child(1) td").length < 2) {
      $(this).addClass("one-column");
    }
  })

  if ($(".taxonomy-tab-contents table").length) {
    $(".taxonomy-tab-contents table").wrap(
      "<div style='overflow-x:auto'></div>"
    );
  }
  $(".taxonomy-tab-contents img").each(function () {
    if ($(this).closest("a").length) {
      $(this).closest("a").attr("data-fancybox", "");
    } else {
      $(this).wrap("<a href='" + $(this).attr("src") + "' data-fancybox></a>");
    }
  });
});
