<?php

namespace Suno\Subscription\Block\Product\View;

use Magento\Framework\View\Element\Template;
use Magento\Framework\Registry;
use Suno\Subscription\Model\PlanProduct;
use Suno\Subscription\Model\Plan as PlanModel;


class Plan extends Template
{
    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @var \Magento\Catalog\Model\Product
     */
    protected $product;

    /**
     * @var PlanProduct
     */
    protected $planProductFactory;

    /**
     * @var PlanModel
     */
    protected $planFactory;

    /**
     * Construtor
     *
     * @param Template\Context $context
     * @param array $data
     * @param Registry $registry
     */
    public function __construct(
        Template\Context $context,
        PlanProduct      $planProductFactory,
        PlanModel        $planFactory,
        Registry         $registry,
        array            $data = []
    )
    {
        $this->registry = $registry;
        $this->planProductFactory = $planProductFactory;
        $this->planFactory = $planFactory;
        parent::__construct($context, $data);
    }

    /**
     * Retorna o produto
     *
     * @return \Magento\Catalog\Model\Product
     */
    public function getProduct()
    {
        if ($this->product === null) {
            $this->product = $this->registry->registry('product');
        }

        return $this->product;
    }

    /**
     * Retorna os planos de assinaturas para determinado produto
     *
     * @return array
     */
    public function getPlans(): array
    {
        $collection = $this->planProductFactory->getCollection()
            ->addFieldToFilter('product_id', $this->getProduct()->getEntityId());

        $result = [];
        foreach ($collection as $item) {
            $plan = $this->planFactory->getCollection()
                ->addFieldToFilter('entity_id', $item->getPlanId())
                ->addFieldToFilter('is_active', 1)
                ->getFirstItem();
            if (empty($plan->getData())) {
                continue;
            }
            $result[] = $plan;
        }
        return $result;
    }
}
