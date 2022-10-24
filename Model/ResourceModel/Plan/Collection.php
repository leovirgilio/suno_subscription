<?php

namespace Suno\Subscription\Model\ResourceModel\Plan;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Suno\Subscription\Model\Plan as Model;
use Suno\Subscription\Model\ResourceModel\Plan as ResourceModel;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'suno_subscription_plan_collection';

    /**
     * Initialize collection model.
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
