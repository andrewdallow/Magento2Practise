<?php

namespace Training\ProductList\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\View\Result\PageFactory;
use Training\ProductList\Setup\InstallData;

/**
 * Class Index
 *
 * Long description for Class (if any)...
 *
 * @category   Training
 * @package    Training_ProductList
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class Index extends Action
{
    /** @var \Magento\Catalog\Model\ResourceModel\Product\Collection */
    private $productCollection;
    /** @var \Magento\Framework\View\Result\PageFactory */
    private $pageFactory;
    
    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory,
        PageFactory $pageFactory
    ) {
        $this->pageFactory = $pageFactory;
        $this->productCollection = $collectionFactory->create();
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
        $result = $this->pageFactory->create();
        $this->initialiseProductListCollection();
        
        /** @var \Training\ProductList\Block\ListProduct $list */
        $list = $result->getLayout()->getBlock('custom.products.list');
        $list->setProductCollection($this->productCollection);
        
        return $result;
    }
    
    private function initialiseProductListCollection()
    {
        $this->productCollection
            ->addAttributeToSelect('*')
            ->addAttributeToFilter(InstallData::PRODUCT_LIST_ATTRIBUTE, 1)
            ->addAttributeToSort(
                $this->getRequest()->getParam('product_list_order'),
                $this->getRequest()->getParam('product_list_dir')
            );
    }
}
