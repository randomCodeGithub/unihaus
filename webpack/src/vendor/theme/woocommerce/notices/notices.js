$(document).ready(function () {
  var $d = $(document);
  $d.on(
    "click",
    ".woocommerce-message .js-close-notice, .woocommerce-message-wrapper .woocommerce-message-background",
    function () {
      $(".woocommerce-message-wrapper").hide();
    }
  );
});
