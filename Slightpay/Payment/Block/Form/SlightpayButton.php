<?php
namespace Slightpay\Payment\Block\Form;

class SlightpayButton extends \Magento\Payment\Block\Form
{
    /**
     * Slightpay template
     * This is used for both frontend and backend
     * I created two files named slightpay-button.phtml in the path view\adminhtml\templates\form and view\frontend\templates\form because it has different content.
     *
     * @var string
     */
    protected $_template = 'Slightpay_Payment::form/slightpay-button.phtml';
}
