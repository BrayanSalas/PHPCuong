<?php

namespace slightpay\payment\Model;

use Magento\Quote\Api\Data\PaymentInterface;

class SlightpayButton extends \Magento\Payment\Model\Method\AbstractMethod
{
    const PAYMENT_METHOD_PDQPAYMENT_CODE = 'pdqpayment';

    /**
     * Payment method code
     *
     * @var string
     */
    protected $_code = self::PAYMENT_METHOD_PDQPAYMENT_CODE;

    /**
     * @var string
     */
    protected $_formBlockType = \slightpay\payment\Block\Form\SlightpayButton::class;

    /**
     * @var string
     */
    protected $_infoBlockType = \slightpay\payment\Block\Info\SlightpayButton::class;

    /**
     * Availability option
     *
     * @var bool
     */
    protected $_isOffline = true;
}
