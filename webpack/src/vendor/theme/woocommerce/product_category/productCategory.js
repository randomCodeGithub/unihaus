$(document).ready(function () {
  $(".woof_checkbox_term_custom").change(function () {
    if ($(this).prop("checked")) {
      var data_href = $(this).attr("data-href");
      if (typeof data_href !== "undefined" && data_href !== false) {
        window.location.href = data_href;
      }
    }
  });
});
