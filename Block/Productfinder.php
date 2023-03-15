<?php

namespace Sadri\Office\Block;

class Productfinder extends \Magento\Framework\View\Element\Template
{
    
    public function getProductBySku($sku) 
    {
        return $this->_productRepository->get($sku);
    }

}