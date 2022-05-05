$(document).ready(function () {
  var $d = $(document);

  function qtyInputElementValueChange(element) {
    var $qtyMinusElement = element
      .parent()
      .parent()
      .find(".woopq-quantity-input-minus");
    if (element.val() > 1) {
      // qty input value >=10
      if (element.val() >= 10) {
        element
          .css("padding-right", "calc(1.8rem - 5px)")
          .next(".item-name")
          .css("right", "-3px");
      } else {
        element.attr("style", "").next(".item-name").attr("style", "");
      }
      $qtyMinusElement.removeClass("d-none");
    } else {
      $qtyMinusElement.addClass("d-none");
    }
  }

  if ($(".qty").length) {
    $(".qty").each(function () {
      qtyInputElementValueChange($(this));
    });
  }

  // Increasing/decreasing product count ajax complete
  $d.ajaxComplete(function () {
    $(".qty").each(function () {
      qtyInputElementValueChange($(this));
    });
  });
  
  var timeout;
  //   Check product count field change
  $d.on("change", "input.qty", function () {
    var $updateCartBtn = $("[name='update_cart']");
    qtyInputElementValueChange($(this));

    if ($updateCartBtn.length) {
      //   Clear timeout if user increase/decrease product count and time in timeout not pass 1000ms
      if (timeout !== undefined) {
        clearTimeout(timeout);
      }
      // If user stop increase/decrease product count - after 1000ms "Update cart" btn will be triggered
      timeout = setTimeout(function () {
        $("[name='update_cart']").trigger("click");
      }, 1000);
    }
  });
});
