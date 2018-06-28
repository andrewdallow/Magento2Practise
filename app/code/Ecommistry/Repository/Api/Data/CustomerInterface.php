<?php

namespace Ecommistry\Repository\Api\Data;

/**
 * Interface CustomerInterface
 *
 * @category   Ecommistry
 * @package    Ecommistry_Repository
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
interface CustomerInterface
{
    public const IS_FIELD = 'customer_id';
    public const FIRST_NAME = 'first_name';
    public const LAST_NAME = 'last_name';
    public const ADDRESS = 'address';
    public const COUNTRY = 'country';
    
    /**
     * @return mixed
     */
    public function getId();
    
    /**
     * @param $id
     *
     * @return mixed
     */
    public function setId($id);
    
    /**
     * @return string
     */
    public function getFirstName(): string;
    
    /**
     * @param string $firstName
     *
     * @return void
     */
    public function setFirstName(string $firstName): void;
    
    /**
     * @return string
     */
    public function getLastName(): string;
    
    /**
     * @param string $lastName
     *
     * @return void
     */
    public function setLastName(string $lastName): void;
    
    /**
     * @return string
     */
    public function getAddress(): string;
    
    /**
     * @param string $address
     *
     * @return void
     */
    public function setAddress(string $address): void;
    
    /**
     * @return string
     */
    public function getCountry(): string;
    
    /**
     * @param string $country
     *
     * @return void
     */
    public function setCountry(string $country): void;
}
