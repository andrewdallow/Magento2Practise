<?php

namespace Training\ExtAttribute\Model\Category;

use Magento\Framework\Model\AbstractModel;
use Training\ExtAttribute\Api\Data\CountryInterface;

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
    public function getCountry()
    {
        return $this->getData(self::COUNTRY);
    }
    
    /**
     * @param $name
     *
     * @return void
     */
    public function setCountry($name)
    {
        $this->setData(self::COUNTRY, $name);
    }
    
    /**
     * @return int
     */
    public function getCategoryId()
    {
        return $this->getData(self::CATEGORY_ID);
    }
    
    /**
     * @param $id
     *
     * @return void
     */
    public function setCategoryId($id)
    {
        $this->setData(self::CATEGORY_ID, $id);
    }
    
}
