$(document).ready(function () {
  var $d = $(document);
  $(".cities select").select2({ width: "100%" });

  function checkValidation(re, element) {
    return re.test(element);
  }

  function isEmail(email) {
    let re =
      /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return checkValidation(re, email);
  }

  function isLatvianPhone(phone) {
    let re = /^(\+371)?([\s]?)([2]\d{1})([\s]?)(\d{3})([\s]?)(\d{3})$/;
    return checkValidation(re, phone);
  }

  $d.on("change", ".validate-phone input", function () {
    if ($(this).val()) {
      if (!isLatvianPhone($(this).val())) {
        if ($(".validate-phone input").parent().find(".error-phone").length) {
          if (
            $(".validate-phone input")
              .parent()
              .find(".error-phone")
              .hasClass("d-none")
          ) {
            $(".validate-phone input")
              .parent()
              .find(".error-phone")
              .removeClass("d-none");
          }
          $(".validate-phone input")
            .parent()
            .find(".error-invalid-phone")
            .attr("style", "display: none !important");
        } else {
          $(".validate-phone input")
            .parent()
            .find(".error-invalid-phone")
            .attr("style", "display: block !important");
          $(".validate-phone .error-required").attr(
            "style",
            "display: none !important"
          );
        }
        $(this).closest(".validate-phone").addClass("woocommerce-invalid");
        $(this).closest(".validate-phone").removeClass("woocommerce-validated");
      } else {
        if ($(".validate-phone input").parent().find(".error-phone").length) {
          $(".validate-phone input")
            .parent()
            .find(".error-phone")
            .addClass("d-none");
        }
        $(".validate-phone input")
          .parent()
          .find(".error-invalid-phone")
          .attr("style", "display: none !important");
      }
    } else {
      $(".validate-phone .error-required").attr(
        "style",
        "display: block !important"
      );

      if ($(".validate-phone input + .error-phone").length) {
        if (!$(".validate-phone input + .error-phone").hasClass("d-none")) {
          $(".validate-phone input + .error-phone").addClass("d-none");
        }
      } else {
        $(".validate-phone input")
          .parent()
          .find(".error-invalid-phone")
          .attr("style", "display: none !important");
        $(".validate-phone .error-required").attr(
          "style",
          "display: block !important"
        );
      }
    }
  });

  $d.on("input", ".validate-phone input", function () {
    if ($(this).val()) {
      $(".validate-phone .error-required").attr(
        "style",
        "display: none !important"
      );
      if (!isLatvianPhone($(this).val())) {
        $(this).closest(".validate-phone").addClass("woocommerce-invalid");
        $(this).closest(".validate-phone").removeClass("woocommerce-validated");
      } else {
        $(this).closest(".validate-phone").removeClass("woocommerce-invalid");
        $(this).closest(".validate-phone").addClass("woocommerce-validated");
      }
    } else {
      $(this).closest(".validate-phone").addClass("woocommerce-invalid");
      $(this).closest(".validate-phone").removeClass("woocommerce-validated");
    }
  });

  $d.on("change", ".validate-email input", function () {
    if ($(this).val()) {
      if (!isEmail($(this).val())) {
        $(".validate-email span.error-required").attr(
          "style",
          "display: none !important"
        );
        $(".validate-email span.error-invalid-password").attr(
          "style",
          "display: block !important"
        );
      } else {
        $(
          ".validate-email span.error-required, .woocommerce-invalid.validate-email span.error-invalid-password, .validate-email span.error-invalid-password"
        ).attr("style", "display: none !important");
      }
    } else {
      $(".validate-email span.error-required").attr(
        "style",
        "display: block !important"
      );
      $(".validate-email span.error-invalid-password").attr(
        "style",
        "display: none !important"
      );
    }
  });

  $d.ajaxComplete(function () {
    if (
      $(
        ".woocommerce-invalid.validate-phone input, .woocommerce-validated.validate-phone input"
      ).val()
    ) {
      if (!isLatvianPhone($(".validate-phone input").val())) {
        $(
          ".woocommerce-invalid.validate-phone input, .woocommerce-validated.validate-phone input"
        )
          .closest(".validate-phone")
          .addClass("woocommerce-invalid");
        $(
          ".woocommerce-invalid.validate-phone input, .woocommerce-validated.validate-phone input"
        )
          .closest(".validate-phone")
          .removeClass("woocommerce-validated");

        $(
          ".woocommerce-invalid.validate-phone input, .woocommerce-validated.validate-phone input"
        )
          .parent()
          .find(".error-invalid-phone")
          .attr("style", "display: none !important");
      } else {
        $(
          ".woocommerce-invalid.validate-phone input, .woocommerce-validated.validate-phone input"
        )
          .closest(".validate-phone")
          .removeClass("woocommerce-invalid");
      }
    } else {
      $(
        ".woocommerce-invalid.validate-phone input, .woocommerce-validated.validate-phone input"
      )
        .closest(".validate-phone")
        .addClass("woocommerce-invalid");
    }

    if ($(".coupon-error").length) {
      $(".checkout_coupon").after($(".coupon-error"));
    }
    if ($(".error-phone").length) {
      if ($(".validate-phone input + .error-phone").length == 0)
        $(".validate-phone input").after($(".error-phone"));
    }

    if ($(".woocommerce-invalid.validate-email").length) {
      if ($(".validate-email input").val()) {
        if (!isEmail($(".validate-email input").val())) {
          $(".validate-email span.error-required").attr(
            "style",
            "display: none !important"
          );
          $(".validate-email span.error-invalid-password").attr(
            "style",
            "display: block !important"
          );
        } else {
          $(
            ".validate-email span.error-required, .validate-email span.error-invalid-password"
          ).attr("style", "display: none !important");
        }
      } else {
        $(".validate-email span.error-required").attr(
          "style",
          "display: block !important"
        );
        $(".validate-email span.error-invalid-password").attr(
          "style",
          "display: none !important"
        );
      }
    }
  });

  var timeout;

  $(".woocommerce").on("change", "input[name='coupon_code']", function () {
    $("[name='apply_coupon']").trigger("click");
  });

  function checkboxesChecked(checkbox) {
    if (checkbox.is(":checked")) {
      checkbox.parent().addClass("checkbox-checked");
    } else {
      checkbox.parent().removeClass("checkbox-checked");
    }
  }

  var checkboxs = $(".woocommerce form .form-row label.checkbox input");

  checkboxs.each(function () {
    checkboxesChecked($(this));
  });

  checkboxs.change(function () {
    checkboxesChecked($(this));
  });
});
