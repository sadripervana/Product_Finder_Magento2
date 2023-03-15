<?php

namespace Sadri\Office\Controller\Adminhtml\Logs;

use \Magento\Backend\App\Action\Context;
use \Magento\Framework\View\Result\PageFactory;
use \Magento\Backend\App\Action;

class Index extends Action
{
    protected $resultPageFactory = false;

    public function __construct(
    Context $context,
    PageFactory $resultPageFactory
    ){
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Logs')));

        return $resultPage;
    }
  }