<?php

namespace Slightpay\Payment\Block;

/**
 * SlightPay
 *
 * @api
 */
class SlightPayApi extends \Magento\Framework\View\Element\Template
{
    const COMMERCE_ID = 'payment/pdqpayment/commerceid';
    const COMMERCE_KEY = 'payment/pdqpayment/commercekey';
    const SANDBOX_MODE = 'payment/pdqpayment/sandbox';
    const SLIGHTPAY_URL = 'https://api.slightpay.com/pay-button/';
    const SLIGHTPAY_SANDBOXURL = 'https://api-staging.slightpay.com/pay-button/';

    /**
     * Retrieve SlightPay URL
     *
     * @return string
     */
    public function getSlightpayUrl(): ?string
    {
        $url = ($this->getSandbox() ? self::SLIGHTPAY_SANDBOXURL : self::SLIGHTPAY_URL);
        return $url;
    }

    /**
     * Retrieve Commerce ID
     *
     * @return string
     */
    public function getCommerceID(): ?string
    {
        return $this->_scopeConfig->getValue(self::COMMERCE_ID);
    }

    /**
     * Retrieve Commerce KEY
     *
     * @return string
     */
    public function getCommerceKey(): ?string
    {
        return $this->_scopeConfig->getValue(self::COMMERCE_KEY);
    }

    /**
     * Sandbox
     *
     * @return string
     */
    public function getSandbox(): ?string
    {
        return $this->_scopeConfig->getValue(self::SANDBOX_MODE);
    }

    /**
     * Generate URL for retrieving JS Code
     *
     * @return string
     */
    public function getApiUrl(): string
    {
        $apiUrl = $this->getSlightpayUrl() . $this->getCommerceID() . '?key=' . $this->getCommerceKey();
        if ($this->getSandbox()) {
            $apiUrl .= '&sandbox=true';
        } else {
            $apiUrl .= '&production=false';
        }
        return $apiUrl;
    }
}
