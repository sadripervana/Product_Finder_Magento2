<?php

namespace Sadri\Office\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Logs extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('logs','id');
    }
}