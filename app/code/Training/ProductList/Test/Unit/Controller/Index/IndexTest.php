<?php
/**
 * Short description for file
 *
 * Long description for file (if any)...
 *
 * @category   ${package}
 * @package    ${package}_${extension}
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */

namespace Training\ProductList\Test\Unit\Controller\Index;

use Magento\Catalog\Model\ResourceModel\Product\Collection;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use PHPUnit\Framework\TestCase;
use Training\ProductList\Controller\Index\Index;
use Magento\Framework\View\LayoutInterface;
use Training\ProductList\Block\ListProduct;
use Training\ProductList\Helper\Config;

class IndexTest extends TestCase
{
    /** @var \Training\ProductList\Controller\Index\Index */
    private $action;
    
    /** @var \Magento\Catalog\Model\ResourceModel\Product\Collection */
    private $productCollection;
    /** @var \Magento\Framework\Controller\ResultFactory */
    private $pageFactory;
    /** @var \Magento\Framework\View\Result\Page */
    private $page;
    /** @var \Magento\Customer\Model\Session */
    private $session;
    
    private $urlInterface;
    /** @var \Magento\Framework\View\LayoutInterface */
    private $layout;
    /** @var \Training\ProductList\Block\ListProduct */
    private $block;
    /** @var \Training\ProductList\Helper\Config */
    private $configHelper;
    
    public function setUp()
    {
        
        $objectManager = new ObjectManager($this);
    
        $this->configHelper = $this->createMock(Config::class);
        $this->productCollection = $this->createMock(Collection::class);
        $this->pageFactory = $this->createMock(PageFactory::class);
        $this->page = $this->createMock(Page::class);
        $this->session = $this->createMock(Session::class);
        $this->layout = $this->createMock(LayoutInterface::class);
        $this->block = $this->createMock(ListProduct::class);
        $context
            = $this->createMock(Context::class);
        $this->urlInterface = $this->createMock(UrlInterface::class);
        
        $context->expects($this->atLeastOnce())
            ->method('getUrl')
            ->willReturn($this->urlInterface);
        
        $this->action = $objectManager->getObject(
            Index::class,
            [
                'context'           => $context,
                'productCollection' => $this->productCollection,
                'pageFactory'       => $this->pageFactory,
                'session'           => $this->session,
                'configHelper'      => $this->configHelper
            ]
        );
    }
    
    public function tearDown()
    {
        $this->action = null;
    }
    
    public function testExecuteCustomerLoggedOnAndHasProducts()
    {
        $numProductsToShow = 10;
        $this->pageFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($this->page));
        
        $this->session->expects($this->once())
            ->method('isLoggedIn')
            ->willReturn(true);
        
        $this->page->expects($this->once())
            ->method('getLayout')
            ->willReturn($this->layout);
        
        $this->layout->expects($this->once())
            ->method('getBlock')
            ->with('custom.products.list')
            ->willReturn($this->block);
    
        $this->configHelper->expects($this->once())
            ->method('getNumberOfProductsToShow')
            ->willReturn($numProductsToShow);
        
        $this->productCollection->expects($this->once())
            ->method('addAttributeToSelect')
            ->with('*')
            ->willReturnSelf();
        
        $this->productCollection->expects($this->once())
            ->method('addAttributeToFilter')
            ->with('handle_display', 1)
            ->willReturnSelf();
    
        $this->productCollection->expects($this->once())
            ->method('setPageSize')
            ->willReturnSelf();
    
        $this->productCollection->expects($this->once())
            ->method('load')
            ->willReturnSelf();
        
        $this->block->expects($this->once())
            ->method('setProductCollection')
            ->with($this->productCollection);
        
        $result = $this->action->execute();
        
        $this->assertEquals($this->page, $result);
    }
    
    public function testExecuteCustomerLoggedOnAndNoProducts()
    {
        $numProductsToShow = 0;
        $this->pageFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($this->page));
        
        $this->session->expects($this->once())
            ->method('isLoggedIn')
            ->willReturn(true);
        
        $this->page->expects($this->once())
            ->method('getLayout')
            ->willReturn($this->layout);
        
        $this->layout->expects($this->once())
            ->method('getBlock')
            ->with('custom.products.list')
            ->willReturn($this->block);
        
        $this->configHelper->expects($this->once())
            ->method('getNumberOfProductsToShow')
            ->willReturn($numProductsToShow);
        
        $this->productCollection->expects($this->once())
            ->method('addFieldToFilter')
            ->with('entity_id', 0)
            ->willReturnSelf();
        
        $this->productCollection->expects($this->once())
            ->method('load')
            ->willReturnSelf();
        
        $this->block->expects($this->once())
            ->method('setProductCollection')
            ->with($this->productCollection);
        
        $result = $this->action->execute();
        
        $this->assertEquals($this->page, $result);
    }
    
    public function testExecuteCustomerLoggedOff()
    {
        $url = '/current-url';
        $this->pageFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($this->page));
        
        $this->session->expects($this->once())
            ->method('isLoggedIn')
            ->willReturn(false);
        
        $this->urlInterface->expects($this->once())
            ->method('getCurrentUrl')
            ->willReturn($url);
        
        $this->session->expects($this->once())
            ->method('setAfterAuthUrl')
            ->willReturnSelf();
        
        $this->session->expects($this->once())
            ->method('authenticate');
        
        $result = $this->action->execute();
        
        $this->assertEquals($this->page, $result);
    }
}
