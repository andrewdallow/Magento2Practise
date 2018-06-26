<?php

namespace Training\ExtAttribute\Model\Category;

use Magento\Framework\Model\AbstractModel;
use Training\ExtAttribute\Api\Data\Category\CountryInterface;

/**
 * Class Country
 *
 * Long description for Class (if any)...
 *
 * @category   Training
 * @package    Training_ExtAttribute
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class Country extends AbstractModel implements CountryInterface
{
    protected function _construct()
    {
        $this->_cacheTag = 'training_extAttribute_country';
        $this->_eventPrefix = 'training_extAttribute_country';
        $this->_init(ResourceModel\Country::class);
    }
    
    /**
     * @return string
     */
    public function getCountryName()
    {
        return $this->getData(self::COUNTRY_NAME);
    }
    
    /**
     * @param $name
     *
     * @return void
     */
    public function setCountryName($name)
    {
        $this->setData(self::COUNTRY_NAME, $name);
    }
    
    /**
     * @return int
     */
    public function getCategoryId()
    {
        return $this->getData(self::COUNTRY_CATEGORY_ID);
    }
    
    /**
     * @param $id
     *
     * @return void
     */
    public function setCategoryId($id)
    {
        $this->setData(self::COUNTRY_CATEGORY_ID, $id);
    }
    
}
