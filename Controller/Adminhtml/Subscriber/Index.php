<?php

namespace Suno\Subscription\Controller\Adminhtml\Subscriber;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\HttpGetActionInterface;

/**
 *
 */
class Index extends Action implements HttpGetActionInterface
{
    /**
     * ACL
     */
    const ADMIN_RESOURCE = 'Suno_Subscription::manage';

    /**
     * @var PageFactory
     */
    private $pageFactory;


    /**
     * @param Context $context
     * @param PageFactory $rawFactory
     */
    public function __construct(
        Context     $context,
        PageFactory $rawFactory
    )
    {
        $this->pageFactory = $rawFactory;

        parent::__construct($context);
    }

    /**
     * Add the main Admin Grid page
     *
     * @return Page
     */
    public function execute(): Page
    {
        $resultPage = $this->pageFactory->create();
        $resultPage->setActiveMenu('Suno_Subscription::subscriber');
        $resultPage
            ->addBreadcrumb(__('Suno Subscriber'), __('Suno Subscriber'))
            ->addBreadcrumb(__('Subscriber'), __('Subscriber'));
        $resultPage->getConfig()->getTitle()->prepend(__('Subscribers'));
        return $resultPage;
    }
}
