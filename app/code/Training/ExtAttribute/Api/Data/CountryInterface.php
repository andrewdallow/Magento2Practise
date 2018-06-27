<?php

namespace Training\ExtAttribute\Api\Data;

/**
 * Interface CountryInterface
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
interface CountryInterface
{
    public const TABLE_NAME = 'training_category_country';
    public const ID_FIELD = 'id';
    public const CATEGORY_ID = 'category_id';
    public const COUNTRY = 'country_name';
    
    /**
     * @param $id
     *
     * @return void
     */
    public function setId($id);
    
    /**
     * @return int
     */
    public function getId();
    
    /**
     * @param $name
     *
     * @return void
     */
    public function setCountry($name);
    
    /**
     * @return string
     */
    public function getCountry();
    
    /**
     * @return void
     */
    public function setCategoryId($id);
    
    /**
     * @return int
     */
    public function getCategoryId();
}
