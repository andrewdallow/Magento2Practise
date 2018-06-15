<?php

namespace Training\ProductList\Block;

use Magento\Catalog\Helper\Product\ProductList;
use Magento\Catalog\Helper\Product\ProductList as ProductListCatalog;
use Magento\Catalog\Model\Config;
use Magento\Catalog\Model\Product\ProductList\Toolbar as ToolbarModel;
use Magento\Catalog\Model\Session;
use Magento\Framework\Data\Helper\PostHelper;
use Magento\Framework\Url\EncoderInterface;
use Magento\Framework\View\Element\Template\Context;
use Training\ProductList\Helper\Config as ConfigHelper;

/**
 * Class Toolbar Block
 *
 * Custom implementation of Magento Toolbar Block
 *
 * @category   Training
 * @package    Training_ProductList
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class Toolbar extends \Magento\Catalog\Block\Product\ProductList\Toolbar
{
    private $helper;
    
    /**
     * Toolbar constructor.
     *
     * @param \Magento\Framework\View\Element\Template\Context   $context
     * @param \Magento\Catalog\Model\Session                     $catalogSession
     * @param \Magento\Catalog\Model\Config                      $catalogConfig
     * @param \Magento\Catalog\Model\Product\ProductList\Toolbar $toolbarModel
     * @param \Magento\Framework\Url\EncoderInterface            $urlEncoder
     * @param \Magento\Catalog\Helper\Product\ProductList        $productListHelper
     * @param \Magento\Framework\Data\Helper\PostHelper          $postDataHelper
     * @param \Training\ProductList\Helper\Config                $config
     * @param array                                              $data
     */
    public function __construct(
        Context $context,
        Session $catalogSession,
        Config $catalogConfig,
        ToolbarModel $toolbarModel,
        EncoderInterface $urlEncoder,
        ProductListCatalog $productListHelper,
        PostHelper $postDataHelper,
        ConfigHelper $config,
        array $data = []
    ) {
        $this->helper = $config;
        parent::__construct(
            $context,
            $catalogSession,
            $catalogConfig,
            $toolbarModel,
            $urlEncoder,
            $productListHelper,
            $postDataHelper,
            $data
        );
    }
    
    /**
     * @return array
     */
    public function getModes()
    {
        switch ($this->helper->isSliderEnabled()) {
            case 1:
                $this->_availableMode = [
                    'grid'   => __('Grid'),
                    'list'   => __('List'),
                    'slider' => __('Slider')
                ];
                break;
            case 0:
                $this->_availableMode = [
                    'grid' => __('Grid'),
                    'list' => __('List')
                ];
                break;
        }
        
        return $this->_availableMode;
    }
    
    /**
     * @return int
     */
    public function getTotalNum()
    {
        return $this->getCollection()
            ->setPageSize($this->helper->getNumberOfProductsToShow())
            ->count();
    }
}
