<?php

namespace Sadri\Office\Controller\Search;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Response\Http;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\UrlInterface;
use Sadri\Office\Model\LogsFactory;

class Result extends Action
{
    protected $response;
    protected $productRepository;
    protected $messageManager;
    protected $logsFactory;
    protected $urlInterface;

    public function __construct(
        Context $context,
        Http $response,
        ProductRepositoryInterface $productRepository,
        ManagerInterface $messageManager,
        UrlInterface $urlInterface,
        LogsFactory $logsFactory
        
    ){
        parent::__construct($context);
        $this->urlInterface = $urlInterface;
        $this->response = $response;
        $this->productRepository = $productRepository;
        $this->messageManager = $messageManager;
        $this->logsFactory = $logsFactory;
    }

    public function execute()
    {
        $postData = $this->getRequest()->getParams();
        $postData["sku"] = trim($postData["sku"]);

        $logsFactory = $this->logsFactory->create();
        if (array_key_exists("sku", $postData)) {
            $logsFactory->setData('searchterm', $postData["sku"]);
            try {
                $product = $this->productRepository->get($postData["sku"]);
                $logsFactory->setData('does_exists', '1');
                $logsFactory->save();
                $url = $product->getProductUrl();
                $this->response->setRedirect($url);
            } catch (\Exception $e) {
                if (strlen($postData["sku"]) > 8) {
                    $this->messageManager->addError(__("More than 8 characters is not allowed"));
                }else if( preg_match("/\s{2,}/", $postData["sku"])) 
                {
                    $this->messageManager->addError(__("More than 1 space is not allowed"));
                } else if(empty($postData["sku"])){
                    $this->messageManager->addError(__("Empty search is not allowed"));
                } else {
                    $this->messageManager->addError(__("Product Not Found"));
                    $logsFactory->setData('does_exists', '0');
                    $logsFactory->save();
                }
                $url = $this->urlInterface->getUrl('productfinder/search/productfinder');
                return $this->_redirect($url);
            }
        }
    }
}