<?php

namespace Training\ProductList\Controller\Index;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\View\Result\PageFactory;
use Training\ProductList\Setup\InstallData;

/**
 * Class Index
 *
 * Control the default index action for the product list
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
    /** @var \Magento\Customer\Model\Session */
    private $session;
    
    private $urlInterface;
    
    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory,
        PageFactory $pageFactory,
        Session $session
    ) {
        $this->session = $session;
        $this->urlInterface = $context->getUrl();
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
        $this->checkLoggedIn();
        $result = $this->pageFactory->create();
        $this->initialiseProductListCollection();
        
        /** @var \Training\ProductList\Block\ListProduct $list */
        $list = $result->getLayout()->getBlock('custom.products.list');
        $list->setProductCollection($this->productCollection);
        
        return $result;
    }
    
    /**
     * Setup the custom product collection.
     */
    private function initialiseProductListCollection()
    {
        $this->productCollection
            ->addAttributeToSelect('*')
            ->addAttributeToFilter(InstallData::PRODUCT_LIST_ATTRIBUTE, 1);
    }
    
    /**
     * Check customer is logged in
     */
    private function checkLoggedIn()
    {
        if (!$this->session->isLoggedIn()) {
            $this->session->setAfterAuthUrl($this->urlInterface->getCurrentUrl());
            $this->session->authenticate();
        }
    }
}
