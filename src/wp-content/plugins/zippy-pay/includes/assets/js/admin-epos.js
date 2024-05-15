"use strict";
$ = jQuery;
$(document).ready(function () {
  var $active_credit_card = $("#woocommerce_zippy_adyen_payment_settings");
  var $active_paynow = $("#woocommerce_zippy_paynow_payment_settings");
  var $zippy_setting_wrapper = $("#zippy_setting_wrapper");

  function toggleCreditCardSection() {
    if ($active_credit_card.is(":checked") || $active_paynow.is(":checked")) {
      $zippy_setting_wrapper.fadeIn();
    } else {
      $zippy_setting_wrapper.fadeOut();
    }
  }

  toggleCreditCardSection(); // Initial state

  $active_credit_card.change(function () {
    toggleCreditCardSection();
  });
  $active_paynow.change(function () {
    toggleCreditCardSection();
  });

  const btnSync = $("#zippy_sync_config");

  btnSync.click(function (e) {
    syncConfigPayment();
  });

  //Ajax Handle
  function syncConfigPayment() {
    $.ajax({
      type: "GET",
      url: "/wp-admin/admin-ajax.php",
      data: {
        action: "sync_config_payment",
      },
      dataType: "json",
      beforeSend: function () {
        btnSync.addClass("updating");
      },
      success: function (data) {
        btnSync.removeClass("updating");
        if (data.status) {
          const is_success = `<p style="color: #2271b1">${data.message}</p>`;
          $(is_success).insertAfter(btnSync);
          setTimeout(function () {
            location.reload(true);
          }, 2000);
        } else {
          const is_failed = `<p style="color: #cc0000">${data.message}</p>`;
          $(is_failed).insertAfter(btnSync);
          btnSync.removeClass("updating");
        }
      },
      error: function (error) {
        const is_failed = '<p style="color: #cc0000">Sync config is failed</p>';
        $(is_failed).insertAfter(btnSync);
      },
      complete: function () {},
    });
  }
});
