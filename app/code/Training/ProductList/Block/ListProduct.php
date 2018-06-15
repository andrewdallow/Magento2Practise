<?php

namespace Training\ProductList\Block;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Block\Product\Context;
use Magento\Catalog\Block\Product\ProductList\Toolbar;
use Magento\Catalog\Model\Layer\Resolver;
use Magento\Catalog\Model\ResourceModel\Collection\AbstractCollection;
use Magento\Framework\Data\Helper\PostHelper;
use Magento\Framework\Url\Helper\Data;
use Training\ProductList\Helper\Config;

/**
 * Class ListProduct
 *
 * Block representing a custom product list with the handle_display attribute.
 *
 * @category   Training
 * @package    Training_ProductList
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class ListProduct extends \Magento\Catalog\Block\Product\ListProduct
{
    /** @var \Training\ProductList\Helper\Config */
    private $configHelper;
    
    /**
     * ListProduct constructor.
     *
     * @param \Magento\Catalog\Block\Product\Context           $context
     * @param \Magento\Framework\Data\Helper\PostHelper        $postDataHelper
     * @param \Magento\Catalog\Model\Layer\Resolver            $layerResolver
     * @param \Magento\Catalog\Api\CategoryRepositoryInterface $categoryRepository
     * @param \Magento\Framework\Url\Helper\Data               $urlHelper
     * @param \Training\ProductList\Helper\Config              $configHelper
     * @param array                                            $data
     */
    public function __construct(
        Context $context,
        PostHelper $postDataHelper,
        Resolver $layerResolver,
        CategoryRepositoryInterface $categoryRepository,
        Data $urlHelper,
        Config $configHelper,
        array $data = []
    ) {
        $this->configHelper = $configHelper;
        parent::__construct(
            $context,
            $postDataHelper,
            $layerResolver,
            $categoryRepository,
            $urlHelper,
            $data
        );
    }
    
    /**
     * @return \Magento\Eav\Model\Entity\Collection\AbstractCollection
     */
    public function getLoadedProductCollection()
    {
        return $this->_productCollection;
    }
    
    public function _prepareLayout()
    {
        $this->pageConfig
            ->getTitle()
            ->set($this->configHelper->getProductListName());
        
        return parent::_prepareLayout();
    }
    
    /**
     * @param \Magento\Catalog\Model\ResourceModel\Collection\AbstractCollection $collection
     */
    public function setProductCollection(AbstractCollection $collection)
    {
        $this->configureToolbar();
        $this->_productCollection = $collection;
    }
    
    /**
     * Configure the custom toolbar
     */
    private function configureToolbar(): void
    {
        /** @var Toolbar $toolbarLayout */
        $toolbar = $this->getToolbarBlock();
        $toolbar->removeOrderFromAvailableOrders('position');
        $toolbar->addOrderToAvailableOrders('created_at', __('New'));
        $toolbar->setDefaultOrder('created_at');
    }
}
