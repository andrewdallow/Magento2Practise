<?php

namespace Training\ExtAttribute\Controller\Index;

use Magento\Catalog\Api\Data\CategoryInterface;
use Magento\Catalog\Helper\Category;
use Magento\Catalog\Model\CategoryRepository;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;

/**
 * Class Index
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
class Index extends Action
{
    /**
     * @var \Magento\Catalog\Helper\Category
     */
    private $category;
    /**
     * @var \Magento\Catalog\Model\CategoryRepository
     */
    private $categoryRepository;
    
    public function __construct(
        Context $context,
        Category $category,
        CategoryRepository $categoryRepository
    ) {
        $this->category = $category;
        $this->categoryRepository = $categoryRepository;
        parent::__construct($context);
    }
    
    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $categories = $this->category->getStoreCategories();
        echo '<ul>';
        foreach ($categories as $category) {
            $categoryObj = $this->categoryRepository->get($category->getId());
            
            echo $this->printCategory($categoryObj);
            $subcategories = $categoryObj->getChildrenCategories();
            echo '<ul>';
            foreach ($subcategories as $subcategory) {
                $subCatObject
                    = $this->categoryRepository->get($subcategory->getId());
                echo $this->printCategory($subCatObject);
            }
            echo '</ul>';
        }
        echo '</ul>';
        die('All Categories Printed');
    }
    
    private function printCategory(CategoryInterface $category)
    {
        $name = $category->getName();
        $id = $category->getId();
        if ($category->getExtensionAttributes()) {
            $country = $category->getExtensionAttributes()->getCountry();
            return $country !== null
                ? "<li><strong>$id: $name, Country: $country</strong></li>"
                : "<li>$id: $name</li>";
        }
    }
}
