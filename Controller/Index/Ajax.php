<?php

namespace Sadri\Office\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Sadri\Office\Model\ResourceModel\Logs\CollectionFactory;

class Ajax extends Action
{
    protected $_resultJsonFactory;
    protected $_collectionFactory;

    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        CollectionFactory $collectionFactory
    )
    {
        $this->_resultJsonFactory = $resultJsonFactory;
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {   
        $response = $this->_resultJsonFactory->create();
        $result = $this->_collectionFactory->create()
        ->addFieldToFilter('does_exists', '1')
        ->getData();
        $response->setData($result);
        return $response;
    }
}