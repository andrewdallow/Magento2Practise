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

namespace Training\ProductList\Test\Unit\Setup;

use Magento\Catalog\Model\Product;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Training\ProductList\Setup\InstallData;
use PHPUnit\Framework\TestCase;

class InstallDataTest extends TestCase
{
    /** @var \Training\ProductList\Setup\InstallData */
    private $installData;
    /** @var \Magento\Eav\Setup\EavSetupFactory */
    private $eavSetupFactory;
    /** @var \Magento\Eav\Setup\EavSetup */
    private $eavSetup;
    
    public function setUp()
    {
        $objectManager = new ObjectManager($this);
        $this->eavSetupFactory = $this->createMock(EavSetupFactory::class);
        $this->eavSetup = $this->createMock(EavSetup::class);
        $this->context = $this->createMock(ModuleDataSetupInterface::class);
        $this->setup = $this->createMock(ModuleContextInterface::class);
        
        $this->installData = $objectManager->getObject(
            InstallData::class,
            [
                'eavSetupFactory' => $this->eavSetupFactory
            ]
        );
        
        
    }
    
    public function testInstallAttrubuteSuccess()
    {
        
        $this->eavSetupFactory->expects($this->once())
            ->method('create')
            ->willReturn($this->eavSetup);
        
        $this->eavSetup->expects($this->once())
            ->method('getAttributeId')
            ->willReturn(false);
        
        $this->eavSetup->expects($this->once())
            ->method('addAttribute')
            ->willReturnSelf();
        
        $this->installData->install($this->context, $this->setup);
    }
    
    public function testInstallAttrubuteAlreadyExists()
    {
        $id = 5;
        $this->eavSetupFactory->expects($this->once())
            ->method('create')
            ->willReturn($this->eavSetup);
        
        $this->eavSetup->expects($this->once())
            ->method('getAttributeId')
            ->with(Product::ENTITY, InstallData::PRODUCT_LIST_ATTRIBUTE)
            ->willReturn($id);
        
        $this->expectException(AlreadyExistsException::class);
        
        $this->installData->install($this->context, $this->setup);
    }
}
