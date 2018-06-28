<?php

namespace Ecommistry\Repository\Model;

use Ecommistry\Repository\Api\Data\CustomerInterface;
use Ecommistry\Repository\Model\ResourceModel\Customer as CustomerResource;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Class Customer Model
 *
 * Represents the Concrete Model of an Ecommistry Customer.
 *
 * @category   Ecommistry
 * @package    Ecommistry_Repository
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class Customer extends AbstractModel implements
    CustomerInterface,
    IdentityInterface
{
    private const CACHE_TAG = 'ecommistry_customer';
    private const EVENT = 'ecommistry_customer';
    
    protected function _construct()
    {
        $this->_cacheTag = self::CACHE_TAG;
        $this->_eventPrefix = self::EVENT;
        $this->_init(CustomerResource::class);
    }
    
    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->getData(self::FIRST_NAME);
    }
    
    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->setData(self::FIRST_NAME, $firstName);
    }
    
    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->getData(self::LAST_NAME);
    }
    
    /**
     * @param string $lastName
     *
     * @return void
     */
    public function setLastName(string $lastName): void
    {
        $this->setData(self::LAST_NAME, $lastName);
    }
    
    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->getData(self::ADDRESS);
    }
    
    /**
     * @param string $address
     *
     * @return void
     */
    public function setAddress(string $address): void
    {
        $this->setData(self::ADDRESS, $address);
    }
    
    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->getData(self::COUNTRY);
    }
    
    /**
     * @param string $country
     *
     * @return void
     */
    public function setCountry(string $country): void
    {
        $this->setData(self::COUNTRY, $country);
    }
    
    /**
     * Return unique ID(s) for each object in system
     *
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
