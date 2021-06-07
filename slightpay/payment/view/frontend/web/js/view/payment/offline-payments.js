define([
    'uiComponent',
    'Magento_Checkout/js/model/payment/renderer-list'
], function (Component, rendererList) {
    'use strict';

    rendererList.push(
        {
            type: 'pdqpayment',
            component: 'slightpay_payment/js/view/payment/method-renderer/slightpay-method'
        }
    );

    /** Add view logic here if needed */
    return Component.extend({});
});
