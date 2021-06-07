<?php
namespace slightpay\payment\Block\Form;

class SlightpayButton extends \Magento\Payment\Block\Form
{
    /**
     * Slightpay template
     * This is used for both frontend and backend
     * I created two files named slightpay-button.phtml in the path view\adminhtml\templates\form and view\frontend\templates\form because it has different content.
     *
     * @var string
     */
    protected $_template = 'slightpay_payment::form/slightpay-button.phtml';
}
