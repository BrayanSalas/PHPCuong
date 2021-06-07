<?php

namespace slightpay\payment\Block\Info;

class SlightpayButton extends \Magento\Payment\Block\Info
{
    /**
     * @var string
     */
    protected $_template = 'slightpay_payment::info/slightpay-button.phtml';

    /**
     * @return string
     */
    public function toPdf()
    {
        $this->setTemplate('slightpay_payment::info/pdf/slightpay-button.phtml');
        return $this->toHtml();
    }
}
