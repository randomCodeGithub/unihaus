$(document).ready(function () {
  $(".product-tabs .uh-btn-tab").on("click", function () {
    if ($(".product-tabs .uh-btn-tab").hasClass("active")) {
      $(".product-tabs .uh-btn-tab").removeClass("active");
    }
    $(this).addClass("active");
    $(".product-tabs .service-tab-contents .service-tab-content").css(
      "display",
      "none"
    );
    $(
      ".product-tabs .service-tab-contents .service-tab-content#" +
        $(this).attr("tab_content")
    ).css("display", "block");
  });

  $(".image-and-text-block ").each(function () {
    paragraphLength = $(this).find("p").length;
    console.log(paragraphLength);
    if (paragraphLength <= 1) {
      $(this).find("a").remove();
    }
  });

  $(".js-read-more").on("click", function () {
    $(this).closest(".image-and-text-block").find("p").show();
    $(this)
      .closest(".image-and-text-block")
      .find(".js-less")
      .addClass("d-inline-block");
    $(this).addClass("d-none");
  });

  $(".js-less").on("click", function () {
    $(this)
      .closest(".image-and-text-block")
      .find("p")
      .not(":first-of-type")
      .hide();
    $(this)
      .closest(".image-and-text-block")
      .find(".js-read-more")
      .removeClass("d-none");
    $(this).removeClass("d-inline-block");
  });
});
