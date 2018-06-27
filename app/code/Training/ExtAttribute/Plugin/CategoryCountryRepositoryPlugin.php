<?php

namespace Training\ExtAttribute\Plugin;

use Magento\Framework\Exception\NoSuchEntityException;
use Training\ExtAttribute\Api\CountryRepositoryInterface;
use Training\ExtAttribute\Api\Data\CountryInterface;
use Training\ExtAttribute\Api\Data\CountryInterfaceFactory;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Api\Data\CategoryExtensionInterfaceFactory;
use Magento\Catalog\Api\Data\CategoryInterface;

/**
 * Class CategoryCountryRepositoryPlugin
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
class CategoryCountryRepositoryPlugin
{
    
    
    /** @var \Magento\Catalog\Api\Data\CategoryExtensionInterfaceFactory */
    private $categoryExtensionFactory;
    /**
     * @var \Training\ExtAttribute\Api\Data\CountryInterfaceFactory
     */
    private $countryFactory;
    /**
     * @var \Training\ExtAttribute\Api\CountryRepositoryInterface
     */
    private $countryRepository;
    
    public function __construct(
        CategoryExtensionInterfaceFactory $categoryExtensionFactory,
        CountryInterfaceFactory $countryFactory,
        CountryRepositoryInterface $countryRepository
    ) {
        
        $this->categoryExtensionFactory = $categoryExtensionFactory;
        $this->countryFactory = $countryFactory;
        $this->countryRepository = $countryRepository;
    }
    
    /**
     * @param \Magento\Catalog\Api\CategoryRepositoryInterface $categoryRepository
     * @param \Magento\Catalog\Api\Data\CategoryInterface      $category
     *
     * @return \Magento\Catalog\Api\Data\CategoryInterface
     */
    public function afterGet(
        CategoryRepositoryInterface $categoryRepository,
        CategoryInterface $category
    ) {
        /** @var \Magento\Catalog\Api\Data\CategoryExtensionInterface $extensionAttributes */
        $extensionAttributes = $category->getExtensionAttributes()
            ?: $this->categoryExtensionFactory->create();
        
        try {
            $country = $this->countryRepository->get(
                $category->getId(),
                CountryInterface::CATEGORY_ID
            );
        } catch (NoSuchEntityException $exception) {
            $category->setExtensionAttributes($extensionAttributes);
            return $category;
        }
        $extensionAttributes->setCountry($country->getCountry());
        $category->setExtensionAttributes($extensionAttributes);
        return $category;
    }
    
    /**
     * @param \Magento\Catalog\Api\CategoryRepositoryInterface $categoryRepository
     * @param \Magento\Catalog\Api\Data\CategoryInterface      $category
     *
     * @return \Magento\Catalog\Api\Data\CategoryInterface
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function afterSave(
        CategoryRepositoryInterface $categoryRepository,
        CategoryInterface $category
    ) {
        $extensionAttributes = $category->getExtensionAttributes()
            ?: $this->categoryExtensionFactory->create();
        
        if ($extensionAttributes !== null
            && $extensionAttributes->getCountry() !== null
        ) {
            try {
                $country = $this->countryRepository->get(
                    $category->getId(),
                    CountryInterface::CATEGORY_ID
                );
            } catch (NoSuchEntityException $exception) {
                $country = $this->countryFactory->create();
            }
            $country->setCategoryId($category->getId());
            $country->setCountry($extensionAttributes->getCountry());
            $this->countryRepository->save($country);
        }
        return $category;
    }
    
}
