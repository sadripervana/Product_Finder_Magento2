<?php

namespace Sadri\Office\Controller\Search;

use \Magento\Framework\App\Action\Context;
use \Magento\Framework\View\Result\PageFactory;
use \Magento\Framework\App\Action\Action;

class ProductFinder extends Action
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
        return $this->resultPageFactory->create();
    }
  }