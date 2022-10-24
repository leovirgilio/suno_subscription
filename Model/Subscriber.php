<?php

namespace Suno\Subscription\Model;

use Magento\Framework\Model\AbstractModel;
use Suno\Subscription\Model\ResourceModel\Subscriber as ResourceModel;

class Subscriber extends AbstractModel
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'suno_subscription_subscriber_model';

    /**
     * Initialize magento model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
