<?php

namespace Training\ProductList\Setup;

use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Model\Entity\Attribute\Source\Boolean;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Class Install Schema
 *
 * Install the ProductList attribute handle_display
 *
 * @category   Training
 * @package    Training_ProductList
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class InstallData implements InstallDataInterface
{
    public const PRODUCT_LIST_ATTRIBUTE = 'handle_display';
    private $eavSetupFactory;
    
    /**
     * InstallData constructor.
     *
     * @param \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory
     */
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }
    
    /**
     * Installs data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface   $context
     *
     * @return void
     */
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $eavSetup = $this->eavSetupFactory->create();
        $eavSetup->addAttribute(
            Product::ENTITY,
            self::PRODUCT_LIST_ATTRIBUTE,
            [
                'group'                   => 'General',
                'type'                    => 'int',
                'label'                   => 'Display on Product List',
                'input'                   => 'select',
                'class'                   => '',
                'source'                  => Boolean::class,
                'global'                  => ScopedAttributeInterface::SCOPE_GLOBAL,
                'default'                 => '0',
                'visible'                 => true,
                'required'                => false,
                'user_defined'            => false,
                'searchable'              => false,
                'filterable'              => true,
                'comparable'              => false,
                'visible_on_front'        => false,
                'unique'                  => false,
                'used_in_product_listing' => true
            ]
        );
    }
}
