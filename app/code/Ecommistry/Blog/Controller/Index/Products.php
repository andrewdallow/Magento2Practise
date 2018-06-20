<?php

namespace Ecommistry\Blog\Controller\Index;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\Search\FilterGroupBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class Products
 *
 * Long description for Class (if any)...
 *
 * @category   Ecommistry
 * @package    Ecommistry_Blog
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class Products extends Action
{
    private const PAGE_SIZE = 6;
    private const MIN_PRICE = 10.00;
    private const MAX_PRICE = 20.00;
    private const VISABILITY = 4;
    private const STATUS = 1;
    
    /** @var \Magento\Catalog\Api\ProductRepositoryInterface */
    private $productRepository;
    /** @var \Magento\Framework\Api\SortOrderBuilder */
    private $searchCriteriaBuilder;
    /** @var \Magento\Framework\Api\SortOrderBuilder */
    private $sortOrderBuilder;
    
    public function __construct(
        Context $context,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        ProductRepositoryInterface $productRepository,
        SortOrderBuilder $sortOrderBuilder
    ) {
        $this->productRepository = $productRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
        parent::__construct($context);
    }
    
    public function execute()
    {
        $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        
        $collection = $this->getProductCollection()->getItems();
        /** @var \Ecommistry\Blog\Controller\Index\Products $block */
        $block = $result->getLayout()->getBlock('blog_products');
        $block->setCollection($collection);
        return $result;
    }
    
    /**
     * Get Product Collection with custom filters, sort order, and size.
     *
     * @return \Magento\Catalog\Api\Data\ProductSearchResultsInterface
     */
    private function getProductCollection()
    {
        $searchCriteriaBuilder = $this->searchCriteriaBuilder;
        
        $searchCriteriaBuilder->addFilter(
            ProductInterface::PRICE,
            self::MIN_PRICE,
            'gteq'
        );
        $searchCriteriaBuilder->addFilter(
            ProductInterface::PRICE,
            self::MAX_PRICE,
            'lteq'
        );
        $searchCriteriaBuilder->addFilter(
            ProductInterface::VISIBILITY,
            self::VISABILITY,
            'eq'
        );
        $searchCriteriaBuilder->addFilter(
            ProductInterface::STATUS,
            self::STATUS,
            'eq'
        );
        
        $sortOrder = $this->sortOrderBuilder
            ->setField(ProductInterface::PRICE)
            ->setDirection(SortOrder::SORT_DESC)->create();
        
        $searchCriteriaBuilder->addSortOrder($sortOrder);
        $searchCriteriaBuilder->setPageSize(self::PAGE_SIZE);
        $searchCriteria = $searchCriteriaBuilder->create();
        
        return $this->productRepository->getList($searchCriteria);
    }
}
