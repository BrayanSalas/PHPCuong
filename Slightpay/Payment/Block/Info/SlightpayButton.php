<?php

namespace Slightpay\Payment\Block\Info;

class SlightpayButton extends \Magento\Payment\Block\Info
{
    /**
     * @var string
     */
    protected $_template = 'Slightpay_Payment::info/slightpay-button.phtml';

    /**
     * @return string
     */
    public function toPdf()
    {
        $this->setTemplate('Slightpay_Payment::info/pdf/slightpay-button.phtml');
        return $this->toHtml();
    }
}
