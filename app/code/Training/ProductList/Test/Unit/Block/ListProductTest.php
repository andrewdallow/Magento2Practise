<?php

namespace Training\ProductList\Test\Unit\Block;

use Magento\Catalog\Block\Product\ProductList\Toolbar;
use Magento\Catalog\Model\Layer;
use Magento\Catalog\Model\Layer\Resolver;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\Product\Type\Simple;
use Magento\Catalog\Model\ResourceModel\Category\Collection;
use Magento\Catalog\Model\ResourceModel\Product\Collection as ProductCollection;
use Magento\Checkout\Helper\Cart;
use Magento\Framework\Data\Helper\PostHelper;
use Magento\Framework\Registry;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Magento\Framework\View\LayoutInterface;
use Magento\Framework\View\Page\Config as PageConfig;
use Magento\Framework\View\Page\Title;
use Training\ProductList\Block\ListProduct;
use PHPUnit\Framework\TestCase;
use Magento\Catalog\Block\Product\Context;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\Pricing\Render;
use Magento\Framework\Url\Helper\Data;
use Training\ProductList\Helper\Config;

class ListProductTest extends TestCase
{
    
    /**
     * @var \Training\ProductList\Block\ListProduct
     */
    protected $block;
    
    /**
     * @var \Magento\Framework\Registry|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $registryMock;
    
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $layerMock;
    
    /**
     * @var \Magento\Framework\Data\Helper\PostHelper|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $postDataHelperMock;
    
    /**
     * @var \Magento\Catalog\Model\Product|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $productMock;
    
    /**
     * @var \Magento\Checkout\Helper\Cart|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $cartHelperMock;
    
    /**
     * @var \Magento\Catalog\Model\Product\Type\Simple|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $typeInstanceMock;
    
    /**
     * @var Data | \PHPUnit_Framework_MockObject_MockObject
     */
    protected $urlHelperMock;
    
    /**
     * @var \Magento\Catalog\Model\ResourceModel\Category | \PHPUnit_Framework_MockObject_MockObject
     */
    protected $catCollectionMock;
    
    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product | \PHPUnit_Framework_MockObject_MockObject
     */
    protected $prodCollectionMock;
    
    /**
     * @var \Magento\Framework\View\LayoutInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    protected $layoutMock;
    
    /**
     * @var \Magento\Catalog\Block\Product\ProductList\Toolbar | \PHPUnit_Framework_MockObject_MockObject
     */
    protected $toolbarMock;
    
    /**
     * @var Context|\PHPUnit_Framework_MockObject_MockObject
     */
    private $context;
    
    /**
     * @var Render|\PHPUnit_Framework_MockObject_MockObject
     */
    private $renderer;
    
    private $configHelper;
    
    private $pageConfig;
    
    public function setUp()
    {
        $objectManager = new ObjectManager($this);
        $this->registryMock = $this->createMock(Registry::class);
        $this->layerMock = $this->createMock(Layer::class);
        /** @var \PHPUnit_Framework_MockObject_MockObject|\Magento\Catalog\Model\Layer\Resolver $layerResolver */
        $layerResolver = $this->getMockBuilder(Resolver::class)
            ->disableOriginalConstructor()
            ->setMethods(['get', 'create'])
            ->getMock();
        $layerResolver->expects($this->any())
            ->method($this->anything())
            ->will($this->returnValue($this->layerMock));
        $this->postDataHelperMock = $this->createMock(PostHelper::class);
        $this->typeInstanceMock = $this->createMock(Simple::class);
        $this->productMock = $this->createMock(Product::class);
        $this->cartHelperMock = $this->createMock(Cart::class);
        $this->catCollectionMock = $this->createMock(Collection::class);
        $this->prodCollectionMock = $this->createMock(ProductCollection::class);
        $this->layoutMock = $this->createMock(LayoutInterface::class);
        $this->toolbarMock = $this->createMock(Toolbar::class);
        
        $this->urlHelperMock = $this->getMockBuilder(Data::class)
            ->disableOriginalConstructor()->getMock();
        $this->context = $this->getMockBuilder(Context::class)
            ->disableOriginalConstructor()->getMock();
        $this->renderer = $this->getMockBuilder(Render::class)
            ->disableOriginalConstructor()->getMock();
        $eventManager = $this->getMockForAbstractClass(ManagerInterface::class,
            [], '', false);
        $this->pageConfig = $this->createMock(PageConfig::class);
        
        $this->context->expects($this->any())->method('getRegistry')
            ->willReturn($this->registryMock);
        $this->context->expects($this->any())->method('getCartHelper')
            ->willReturn($this->cartHelperMock);
        $this->context->expects($this->any())->method('getLayout')
            ->willReturn($this->layoutMock);
        $this->context->expects($this->any())->method('getEventManager')
            ->willReturn($eventManager);
        $this->context->expects($this->any())->method('getPageConfig')
            ->willReturn($this->pageConfig);
        $this->configHelper = $this->createMock(Config::class);
        
        
        $this->block = $objectManager->getObject(
            ListProduct::class,
            [
                'registry'       => $this->registryMock,
                'context'        => $this->context,
                'layerResolver'  => $layerResolver,
                'cartHelper'     => $this->cartHelperMock,
                'postDataHelper' => $this->postDataHelperMock,
                'urlHelper'      => $this->urlHelperMock,
                'configHelper'   => $this->configHelper
            ]
        );
        $this->block->setToolbarBlockName('mock');
    }
    
    public function tearDown()
    {
        $this->block = null;
    }
    
    public function testSetProductCollectionCollectionWasSet()
    {
        $this->layoutMock->expects($this->once())
            ->method('getBlock')
            ->will($this->returnValue($this->toolbarMock));
        
        $this->toolbarMock->expects($this->once())
            ->method('removeOrderFromAvailableOrders')
            ->will($this->returnValue($this->toolbarMock));
        
        $this->toolbarMock->expects($this->once())
            ->method('addOrderToAvailableOrders')
            ->will($this->returnValue($this->toolbarMock));
        
        $this->toolbarMock->expects($this->once())
            ->method('setDefaultOrder')
            ->will($this->returnValue($this->toolbarMock));
        
        $this->block->setProductCollection($this->prodCollectionMock);
        $collection = $this->block->getLoadedProductCollection();
        $this->assertEquals($this->prodCollectionMock, $collection);
    }
    
    public function testPrepareLayoutSettingTitle()
    {
        $title = $this->createMock(Title::class);
        
        $this->pageConfig->expects($this->once())
            ->method('getTitle')
            ->willReturn($title);
        
        $this->configHelper->expects($this->once())
            ->method('getProductListName')
            ->willReturn('');
        
        $title->expects($this->once())
            ->method('set')
            ->willReturn($title);
        
        $this->block->_prepareLayout();
        
    }
}
