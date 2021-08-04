<?php

namespace slightpay\payment\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;

class OrderPlaceAfterObserver implements ObserverInterface
{
    public function execute(Observer $observer){
        try {
            $order = $observer->getEvent()->getOrder();
            if($order->getPayment()->getMethod() == 'pdqpayment'){
                $orderState = \Magento\Sales\Model\Order::STATE_COMPLETE;
                $order->setState($orderState)->setStatus(\Magento\Sales\Model\Order::STATE_COMPLETE);
                $order->save();
            }
        } catch (\Exception $e) {
            $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/OrderPlaceAfterException.log');
            $logger = new \Zend\Log\Logger();
            $logger->addWriter($writer);
            $logger->info($e->getMessage());
        }
    }
}