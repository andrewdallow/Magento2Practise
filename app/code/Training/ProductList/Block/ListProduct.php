<?php

namespace Training\ProductList\Block;

use Magento\Catalog\Block\Product\ProductList\Toolbar;
use Magento\Catalog\Model\ResourceModel\Collection\AbstractCollection;

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
    
    /**
     * @return \Magento\Eav\Model\Entity\Collection\AbstractCollection
     */
    public function getLoadedProductCollection()
    {
        return $this->_productCollection;
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
