<?php

namespace Suno\Subscription\Model\ResourceModel\Subscriber;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Suno\Subscription\Model\ResourceModel\Subscriber as ResourceModel;
use Suno\Subscription\Model\Subscriber as Model;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'suno_subscription_subscriber_collection';

    /**
     * Initialize collection model.
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
