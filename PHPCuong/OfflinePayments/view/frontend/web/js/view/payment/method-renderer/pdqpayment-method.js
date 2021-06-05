/**
 * GiaPhuGroup Co., Ltd.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GiaPhuGroup.com license that is
 * available through the world-wide-web at this URL:
 * https://www.giaphugroup.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    PHPCuong
 * @package     PHPCuong_OfflinePayments
 * @copyright   Copyright (c) 2020-2021 GiaPhuGroup Co., Ltd. All rights reserved. (http://www.giaphugroup.com/)
 * @license     https://www.giaphugroup.com/LICENSE.txt
 */
define([
    'Magento_Checkout/js/view/payment/default',
    'jquery',
    'Magento_Checkout/js/model/totals',
    'Magento_Ui/js/modal/modal',
    'mage/validation',
    'require'
], function (Component, $, mageTotal, modal) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'PHPCuong_OfflinePayments/payment/pdqpayment-form',
            assistantId: ''
        },

        initialize: function () {
            this._super()
            require(['slightpay'], function (slightpay) {
                console.log('it works on the slightpay', slightpay)
                console.log('totals', mageTotal.totals)

                let { shipping_amount, shipping_discount_amount, items, subtotal_incl_tax, tax_amount, base_discount_amount } = mageTotal.totals._latestValue

                console.log(shipping_amount, shipping_discount_amount, items, subtotal_incl_tax, tax_amount, base_discount_amount)

                let subtotal = subtotal_incl_tax
                let tax = tax_amount
                let discountShippingFee = shipping_discount_amount < 0 ? shipping_discount_amount * -1 : shipping_discount_amount
                let shipping = shipping_amount - discountShippingFee
                let discount = base_discount_amount < 0 ? base_discount_amount * -1 : base_discount_amount
                let products = []

                items.map((item) => {
                    products.push({ name: `${item.name}`, amount: item.price, quantity: item.qty })
                })

                if (discount !== 0) {
                    products.some((product, key) => {
                        let total = product.quantity * product.amount
                        let dis
                        if (discount <= total) {
                            // descuento para el producto de manera equitativa        
                            dis = discount / product.quantity
                            products[key].amount = product.amount - dis
                            return products
                        }
                    })
                }

                console.log(subtotal, tax, shipping, discount, products)

                function loadButton(discountId) {
                    console.log('loadButton')
                    try {
                        require(['slightpay'], function () {
                            console.log(slightpay, 'slightpay')
                        });
                    } catch (e) {
                        console.log(e, 'error en el require')
                    }

                    try {
                        // Using library      
                        let Lightpay = slightpay.default;
                        let paymentButtonInstance = new Lightpay(
                            {
                                onSucces: (resp) => {
                                    console.log("success")
                                    document.getElementById('slightpay-order').click()
                                    var options = {
                                        type: 'popup',
                                        responsive: true,
                                        title: '',
                                        buttons: []
                                    };

                                    var popup = modal(options, $('#header-modal-success'));
                                    $("#header-modal-success").modal("openModal");
                                },
                                onError: (error) => {
                                    console.error("error", error)
                                    var options = {
                                        type: 'popup',
                                        responsive: true,
                                        title: '',
                                        buttons: []
                                    };

                                    var popup = modal(options, $('#header-modal-error'));
                                    $("#header-modal-error").modal("openModal");
                                },
                                products,
                                totalAmount: false,
                                tax,
                                shippingFee: shipping,
                                idDiscountCode: discountId ? discountId : 0,
                                // orderId: Number(`100`.trim().replace(/[^0-9.]/g, '')),
                                urlPurchase: window.location.href,
                                type: "blue"
                            }
                        ).render('button-container')
                    } catch (e) {
                        console.error(e)
                        document.getElementById('button-container').innerHTML = "<p style='color: red'>El monto total de una compra con Slightpay va desde los $100 hasta los $6000, si su compra supera este monto porfavor notifique al comercio para retirar la orden de compra. </p>"
                    }
                }

                $(document).ready(function () {
                    setTimeout(() => {
                        console.log('testing that workss')
                        loadButton()
                    }, 2000)
                })
            });

            console.log('it works on the backend side...')
            return this
        },

        /** @inheritdoc */
        initObservable: function () {
            this._super()
                .observe('assistantId');

            return this;
        },

        /**
         * @return {Object}
         */
        getData: function () {
            return {
                method: this.item.method,
                'additional_data': {
                    'assistant_id': this.assistantId()
                }
            };
        },

        /**
         * @return {jQuery}
         */
        validate: function () {
            var form = 'form[data-role=pdqpayment-form]';

            return $(form).validation() && $(form).validation('isValid');
        }
    });
});
