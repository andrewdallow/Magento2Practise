<?php

namespace Ecommistry\Repository\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Customer Resource Model
 *
 * Resource Model for accessing Ecommistry Customer Database.
 *
 * @category   Ecommistry
 * @package    Ecommistry_Repository
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class Customer extends AbstractDb
{
    private const TABLE_NAME = 'ecommistry_customer';
    private const TABLE_ID_FIELD = 'customer_id';
    
    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, self::TABLE_ID_FIELD);
    }
}
