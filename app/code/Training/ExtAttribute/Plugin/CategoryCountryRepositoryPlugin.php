<?php

namespace Training\ExtAttribute\Plugin;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Api\Data\CategoryExtensionInterface;
use Magento\Catalog\Api\Data\CategoryInterface;
use Magento\Catalog\Api\Data\CategoryInterfaceFactory;

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
    
    /**
     * @var \Magento\Catalog\Api\CategoryRepositoryInterface
     */
    private $categoryRepository;
    /**
     * @var \Magento\Catalog\Api\Data\CategoryInterfaceFactory
     */
    private $category;
    /**
     * @var \Training\ExtAttribute\Plugin\CategoryExtensionFactory
     */
    private $categoryExtensionFactory;
    
    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        CategoryInterfaceFactory $category,
        CategoryExtensionFactory $categoryExtensionFactory
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->category = $category;
        $this->categoryExtensionFactory = $categoryExtensionFactory;
    }
    
    public function afterGet(
        CategoryRepositoryInterface $categoryRepository,
        CategoryInterface $category
    ) {
        $extensionAttributes = $category->getExtensionAttributes()
            ?: $this->categoryExtensionFactory->create();
        
        
    }
    
}
