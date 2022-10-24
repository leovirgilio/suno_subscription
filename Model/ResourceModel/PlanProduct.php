<?php

namespace Suno\Subscription\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class PlanProduct extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'suno_subscription_plan_product_resource_model';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('suno_subscription_plan_product', 'entity_id');
        $this->_useIsObjectNew = true;
    }
}
