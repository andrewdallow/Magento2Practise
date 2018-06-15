<?php

namespace Training\ProductList\Test\Unit\Block;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Training\ProductList\Block\Toolbar;
use PHPUnit\Framework\TestCase;
use Training\ProductList\Helper\Config;

/**
 * Class ToolbarTest
 *
 * @category   Training
 * @package    Training_ProductList
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class ToolbarTest extends TestCase
{
    private const SLIDER_KEY = 'slider';
    private const SLIDER_ENABLED = 1;
    private const SLIDER_DISABLED = 0;
    
    /** @var Toolbar */
    private $block;
    /** @var Config */
    private $helper;
    
    public function setUp()
    {
        $objectManager = new ObjectManager($this);
        $this->helper = $this->createMock(Config::class);
        $this->block = $objectManager->getObject(
            Toolbar::class,
            ['helper' => $this->helper]
        );
    }
    
    public function testGetModesWithSliderEnabled()
    {
        $this->helper->expects($this->once())
            ->method('isSliderEnabled')
            ->willReturn(self::SLIDER_ENABLED);
        
        $modes = $this->block->getModes();
        
        $this->assertArrayHasKey(self::SLIDER_KEY, $modes);
    }
    
    public function testGetModesWithSliderDisabled()
    {
        $this->helper->expects($this->once())
            ->method('isSliderEnabled')
            ->willReturn(self::SLIDER_DISABLED);
        
        $modes = $this->block->getModes();
        
        $this->assertArrayNotHasKey(self::SLIDER_KEY, $modes);
    }
    
    public function testGetTotalNum()
    {
        $collectionMock = $this->createMock(AbstractCollection::class);
        $propertyName = '_collection';
        $reflectionClass = new \ReflectionClass($this->block);
        
        $property = $reflectionClass->getProperty($propertyName);
        $property->setAccessible(true);
        $property->setValue($this->block, $collectionMock);
        $property->setAccessible(false);
        
        $collectionMock->expects($this->once())
            ->method('setPageSize')
            ->with(2)
            ->willReturnSelf();
        
        $this->helper->expects($this->once())
            ->method('getNumberOfProductsToShow')
            ->willReturn(2);
        
        $collectionMock->expects($this->once())
            ->method('count');
        
        $this->block->getTotalNum();
    }
}
