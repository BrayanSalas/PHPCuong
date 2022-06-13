<?php

namespace Slightpay\Payment\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

class Data extends AbstractHelper
{
    const ACTIVE = 'payment/pdqpayment/active';
    const BRANDING = 'payment/pdqpayment/branding';

    /**
     * @param Context $context
     */
    public function __construct(
        Context $context
    )  {
        parent::__construct($context);
    }

    /**
     * Check if Module it's Active
     * @return mixed
     */
    public function getActiveConfig(): bool
    {
        return $this->scopeConfig->getValue(self::ACTIVE, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get Branding Config
     * @return mixed
     */
    public function getBrandingConfig(): bool
    {
        return $this->scopeConfig->getValue(self::BRANDING, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}
