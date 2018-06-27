<?php

namespace Training\ExtAttribute\Model\Category;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Training\ExtAttribute\Api\CountryRepositoryInterface;
use Training\ExtAttribute\Api\Data\CountryInterface;
use Training\ExtAttribute\Api\Data\CountryInterfaceFactory;
use Training\ExtAttribute\Api\Data\CountrySearchResultInterfaceFactory;
use Training\ExtAttribute\Model\Category\ResourceModel\CountryFactory as CountryResourceFactory;
use Training\ExtAttribute\Model\Category\ResourceModel\Country\CollectionFactory;

/**
 * Class CategoryRepository
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
class CountryRepository implements CountryRepositoryInterface
{
    /**
     * @var \Training\ExtAttribute\Api\Data\CountryInterfaceFactory
     */
    private $countryInterfaceFactory;
    /**
     * @var \Training\ExtAttribute\Model\Category\ResourceModel\CountryFactory
     */
    private $countryResource;
    
    public function __construct(
        CountryInterfaceFactory $countryInterfaceFactory,
        CountryResourceFactory $countryResource
    ) {
        $this->countryInterfaceFactory = $countryInterfaceFactory;
        $this->countryResource = $countryResource;
    }
    
    /**
     * @param \Training\ExtAttribute\Api\Data\CountryInterface $country
     *
     * @return \Training\ExtAttribute\Api\Data\CountryInterface
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function save(CountryInterface $country)
    {
        /** @var \Training\ExtAttribute\Model\Category\ResourceModel\Country $resource */
        $resource = $this->countryResource->create();
        $resource->save($country);
        return $country;
    }
    
    /**
     * @param int $id
     *
     * @return \Training\ExtAttribute\Api\Data\CountryInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id)
    {
        return $this->get($id);
    }
    
    /**
     * @param             $value
     * @param string|null $attributeCode
     *
     * @return \Training\ExtAttribute\Api\Data\CountryInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($value, $attributeCode = null)
    {
        /** @var \Training\ExtAttribute\Model\Category\Country $country */
        $country = $this->countryInterfaceFactory->create();
        /** @var \Training\ExtAttribute\Model\Category\ResourceModel\Country $resource */
        $resource = $this->countryResource->create();
        
        $resource->load($country, $value, $attributeCode);
        if (!$country->getId()) {
            throw new NoSuchEntityException(__('Unable to find Country'));
        }
        return $country;
    }
    
    /**
     * @param \Training\ExtAttribute\Api\Data\CountryInterface $country
     *
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(CountryInterface $country)
    {
        
        /** @var \Training\ExtAttribute\Model\Category\ResourceModel\Country $resource */
        $resource = $this->countryResource->create();
        try {
            $resource->delete($country);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__('Could not delete Country'));
        }
        return true;
    }
    
    /**
     * @param int $id
     *
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($id)
    {
        try {
            $country = $this->getById($id);
            /** @var \Training\ExtAttribute\Model\Category\ResourceModel\Country $resource */
            $resource = $this->countryResource->create();
            
            $resource->delete($country);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__('Could Not Delete Country'));
        }
        return true;
    }
}
