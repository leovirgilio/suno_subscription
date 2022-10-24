<?php

namespace Suno\Subscription\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

/**
 * QuoteSubmitObserver
 */
class QuoteSubmitObserver implements ObserverInterface
{
    private $quoteItems = [];
    private $quote = null;
    private $order = null;

    /**
     * __construct
     *
     * @param \Magento\Store\Model\StoreManagerInterface storeManager
     * @param \Magento\Framework\View\LayoutInterface layout
     * @param \Magento\Framework\App\RequestInterface request
     * @param \Magento\Framework\Serialize\SerializerInterface serializer
     *
     */
    public function __construct(
        \Magento\Store\Model\StoreManagerInterface       $storeManager,
        \Magento\Framework\View\LayoutInterface          $layout,
        \Magento\Framework\App\RequestInterface          $request,
        \Magento\Framework\Serialize\SerializerInterface $serializer
    )
    {
        $this->_layout = $layout;
        $this->_storeManager = $storeManager;
        $this->_request = $request;
        $this->serializer = $serializer;
    }

    /**
     * execute
     *
     * @param EventObserver observer
     *
     * @return void
     */
    public function execute(EventObserver $observer)
    {
        $this->quote = $observer->getQuote();
        $this->order = $observer->getOrder();

        foreach ($this->order->getItems() as $orderItem) {
            if ($quoteItem = $this->getQuoteItemById($orderItem->getQuoteItemId())) {
                if ($additionalOptionsQuote = $quoteItem->getBuyRequest()) {
                    if (isset($additionalOptionsQuote['subscription_plan'])) {
                        $this->persistSubscriber($additionalOptionsQuote['item'], $additionalOptionsQuote['subscription_plan']);
                    }
                }
            }
        }
    }

    private function persistSubscriber($productId, $planId)
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $subscriber = $objectManager->create('Suno\Subscription\Model\Subscriber');

        $subscriber->setData('plan_id', $planId);
        $subscriber->setData('product_id', $productId);
        $subscriber->setData('order_id', $this->order->getEntityId());
        $subscriber->setData('customer_id', $this->order->getCustomerId());

        /* ToDo
        * Persistência do dado para a data de expiração
        * $subscriber->setData('ends_at', $plan->getEndsAt());
        */
        $subscriber->save();
    }

    /**
     * getQuoteItemById
     *
     * @param mixed id
     *
     * @return void
     */
    private function getQuoteItemById($id)
    {
        if (empty($this->quoteItems)) {
            if ($this->quote->getItems()) {
                foreach ($this->quote->getItems() as $item) {
                    $this->quoteItems[$item->getId()] = $item;
                }
            }
        }
        if (array_key_exists($id, $this->quoteItems)) {
            return $this->quoteItems[$id];
        }

        return null;
    }

}
