<?php

namespace Suno\Subscription\Model;

use Magento\Framework\Model\AbstractModel;
use Suno\Subscription\Model\ResourceModel\PlanProduct as ResourceModel;

class PlanProduct extends AbstractModel
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'suno_subscription_plan_product_model';

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
