<?php

/** @var \ZIPPY_Pay\Core\ZIPPY_Adyen_Pay_Gateway $this */ ?>
<div id="zippy-container">
  <?php if (empty($configs)) : ?>
    <span class="zippy-has-error">We can not process the payment at the moment. Please, try again later.</span>
  <?php endif; ?>
</div>
<?php if (!empty($configs)) : ?>
  <input type="hidden" id="zippy_pay_payment_data" name="zippy_pay_payment_data">
  <script type="application/javascript">
    jQuery(document).ready(function() {

      handleChooseMethodPayment();

      function handleChooseMethodPayment() {
		var payment_methods = jQuery('#payment input[type="radio"]');

        if (payment_methods.length == 1) {
          startCheckout();
          return;
        }
		  
        jQuery("#payment_method_zippy_adyen_payment").prop('checked', false);
        jQuery("#payment_method_zippy_adyen_payment").change(function() {

          if (jQuery(this).is(':checked')) {
            startCheckout();
          }
        });
      }

      function handleOnChange(state, component) {

        if (state.isValid === true) {
          console.log(JSON.stringify(state.data));
          jQuery('#zippy_pay_payment_data').val(JSON.stringify(state.data));
        }

      }

      function handleOnError(state, component) {

        jQuery("#zippy-container").replaceWith('<span class="zippy-has-error">We can not process the payment at the moment. Please, try again later.</span>');
      }

      async function startCheckout() {
        try {
          const checkout = await createAdyenCheckout();
          checkout.create("dropin").mount("#zippy-container");
        } catch (e) {
          console.warn(e.message);
          handleOnError();
        }
      }

      async function createAdyenCheckout() {
        return await AdyenCheckout({
          locale: "<?php echo esc_js(get_locale()); ?>",
          environment: "live",
          clientKey: <?php echo json_encode($configs->clientKey); ?>,
          paymentMethodsResponse: <?php echo json_encode($configs->paymentMethods); ?>,
          openFirstStoredPaymentMethod: false,
          showPayButton: false,
          onAdditionalDetails: (state, component) => {
            console.log(JSON.stringify(state.data));

          },
          onPaymentCompleted: (result, component) => {
            console.info(result, component);
          },
          onError: (error, component) => {
            console.error(error.name, error.message, error.stack, component);
          },
          paymentMethodsConfiguration: {
            card: {
              hasHolderName: true,
              holderNameRequired: true,
              billingAddressRequired: false,
              hideCVC: false,

            }
          },
          onChange: handleOnChange,
        })
      }
    });
  </script>
<?php endif; ?>
