<?php

namespace Training\ProductList\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

/**
 * Class Config Helper
 *
 * Retrieve various systems configuration settings.
 *
 * @category   Training
 * @package    Training_ProductList
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class Config extends AbstractHelper
{
    private const PRODUCT_LIST_NAME_PATH = 'product_list/settings/productListName';
    private const PRODUCT_LIST_NUMBER_TO_SHOW_PATH = 'product_list/settings/numberOfProductToList';
    private const PRODUCT_LIST_SLIDER_PATH = 'product_list/settings/slider';
    
    /**
     * @return mixed
     */
    public function getProductListName()
    {
        $name = $this->scopeConfig->getValue(self::PRODUCT_LIST_NAME_PATH);
        return __($name);
    }
    
    /**
     * @return mixed
     */
    public function getNumberOfProductsToShow()
    {
        return $this->scopeConfig->getValue(self::PRODUCT_LIST_NUMBER_TO_SHOW_PATH);
    }
    
    /**
     * @return mixed
     */
    public function isSliderEnabled()
    {
        return $this->scopeConfig->getValue(self::PRODUCT_LIST_SLIDER_PATH);
    }
}
