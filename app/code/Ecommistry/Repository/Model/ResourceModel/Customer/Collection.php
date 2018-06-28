<?php

namespace Ecommistry\Repository\Model\ResourceModel\Customer;

use Ecommistry\Repository\Model\Customer;
use Ecommistry\Repository\Model\ResourceModel\Customer as CustomerResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection of Ecommistry Customers.
 *
 * @category   Ecommistry
 * @package    Ecommistry_Repository
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Customer::class, CustomerResource::class);
    }
}
