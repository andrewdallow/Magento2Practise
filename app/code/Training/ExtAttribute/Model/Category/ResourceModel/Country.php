<?php

namespace Training\ExtAttribute\Model\Category\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Training\ExtAttribute\Setup\InstallSchema;

/**
 * Class Country for Category Country
 *
 * @category   Training
 * @package    Training_ExtAttribute
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class Country extends AbstractDb
{
    
    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            InstallSchema::COUNTRY_TABLE_NAME,
            InstallSchema::ID_FIELD
        );
    }
}
