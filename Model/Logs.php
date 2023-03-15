<?php

namespace Sadri\Office\Model;

use Magento\Framework\Model\AbstractModel;
class Logs extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(
            \Sadri\Office\Model\ResourceModel\Logs::class
        );
    }
}