<?php

namespace Training\ExtAttribute\Model\Category\ResourceModel\Country;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Training\ExtAttribute\Model\Category\Country;
use Training\ExtAttribute\Model\Category\ResourceModel\Country as CountryResourceModel;
use Training\ExtAttribute\Setup\InstallSchema;

/**
 * Class Collection of Category Countries
 *
 * @category   Training
 * @package    Training_ExtAttribute
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
        $this->_idFieldName = InstallSchema::ID_FIELD;
        $this->_init(Country::class, CountryResourceModel::class);
    }
}
