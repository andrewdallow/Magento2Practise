<?php

namespace Training\ExtAttribute\Api;

use Training\ExtAttribute\Api\Data\CountryInterface;

/**
 * Interface CountryRepositoryInterface
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
interface CountryRepositoryInterface
{
    /**
     * @param \Training\ExtAttribute\Api\Data\CountryInterface $country
     *
     * @return \Training\ExtAttribute\Api\Data\CountryInterface
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function save(CountryInterface $country);
    
    /**
     * @param int $id
     *
     * @return \Training\ExtAttribute\Api\Data\CountryInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);
    
    /**
     * @param             $value
     * @param string|null $attributeCode
     *
     * @return \Training\ExtAttribute\Api\Data\CountryInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($value, $attributeCode = null);
    
    /**
     * @param \Training\ExtAttribute\Api\Data\CountryInterface $country
     *
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(CountryInterface $country);
    
    /**
     * @param int $id
     *
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($id);
    
}
