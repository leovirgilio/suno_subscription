<?php

namespace Suno\Subscription\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Stdlib\DateTime\DateTime;

use Suno\Subscription\Model\ResourceModel\Plan as ResourceModel;

class Plan extends AbstractModel
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'suno_subscription_plan_model';


    /**
     * Initialize magento model.
     *
     * @return void
     */
    protected function _construct(
        DateTime $date = null,
    )
    {
        $this->date = $date;
        $this->_init(ResourceModel::class);
    }

    public function getEndsAt()
    {
        $date = $this->date->date('Y-m-d');
        $unit = $this->getBillingFrequencyUnit();
        $add = $this->getBillingFrequency();

        $endsAt = $this->date->date('Y-m-d', strtotime($date . " +{$add} {$unit}s"));
        return $endsAt;
    }
}
