<?php

namespace Slightpay\Payment\Block\Branding;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Slightpay\Payment\Helper\Data as Helper;

/**
 *
 */
class Product extends \Magento\Catalog\Block\Product\View
{
    /**
     * @var Helper
     */
    protected $helper;

    /**
     * @param \Magento\Catalog\Block\Product\Context $context
     * @param \Magento\Framework\Url\EncoderInterface $urlEncoder
     * @param \Magento\Framework\Json\EncoderInterface $jsonEncoder
     * @param \Magento\Framework\Stdlib\StringUtils $string
     * @param \Magento\Catalog\Helper\Product $productHelper
     * @param \Magento\Catalog\Model\ProductTypes\ConfigInterface $productTypeConfig
     * @param \Magento\Framework\Locale\FormatInterface $localeFormat
     * @param \Magento\Customer\Model\Session $customerSession
     * @param ProductRepositoryInterface $productRepository
     * @param \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency
     * @param \Magento\Review\Model\ResourceModel\Review\CollectionFactory $collectionFactory
     * @param array $data
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Catalog\Block\Product\Context                       $context,
        \Magento\Framework\Url\EncoderInterface                      $urlEncoder,
        \Magento\Framework\Json\EncoderInterface                     $jsonEncoder,
        \Magento\Framework\Stdlib\StringUtils                        $string,
        \Magento\Catalog\Helper\Product                              $productHelper,
        \Magento\Catalog\Model\ProductTypes\ConfigInterface          $productTypeConfig,
        \Magento\Framework\Locale\FormatInterface                    $localeFormat,
        \Magento\Customer\Model\Session                              $customerSession,
        ProductRepositoryInterface                                   $productRepository,
        \Magento\Framework\Pricing\PriceCurrencyInterface            $priceCurrency,
        \Magento\Review\Model\ResourceModel\Review\CollectionFactory $collectionFactory,
        Helper                                                       $helper,
        array                                                        $data = []
    ) {
        $this->_reviewsColFactory = $collectionFactory;
        parent::__construct(
            $context,
            $urlEncoder,
            $jsonEncoder,
            $string,
            $productHelper,
            $productTypeConfig,
            $localeFormat,
            $customerSession,
            $productRepository,
            $priceCurrency,
            $data
        );
        $this->helper = $helper;
    }

    /**
     * @return mixed
     */
    public function getActive(): bool
    {
        return $this->helper->getActiveConfig();
    }

    /**
     * Check if Branding it's Enabled
     *
     * @return void
     */
    public function getBranding()
    {
        return $this->helper->getBrandingConfig();
    }
}
