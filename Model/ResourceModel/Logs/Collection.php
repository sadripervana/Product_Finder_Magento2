<?php

namespace Sadri\Office\Model\ResourceModel\Logs;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \Sadri\Office\Model\Logs::class,
            \Sadri\Office\Model\ResourceModel\Logs::class
        );
    }
}