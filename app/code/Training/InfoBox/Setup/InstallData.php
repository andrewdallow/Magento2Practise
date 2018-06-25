<?php

namespace Training\InfoBox\Setup;

use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Psr\Log\LoggerInterface;

/**
 * Class InstallData
 *
 * Install Data for InfoBox Module.
 *
 * @category   Training
 * @package    Training_InfoBox
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class InstallData implements InstallDataInterface
{
    public const INFOBOX_ATTRIBUTE = 'infobox';
    /** @var \Magento\Eav\Setup\EavSetupFactory */
    private $eavSetupFactory;
    /** @var \Psr\Log\LoggerInterface */
    private $logger;
    
    public function __construct(
        EavSetupFactory $eavSetupFactory,
        LoggerInterface $logger
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->logger = $logger;
    }
    
    /**
     * @param \Magento\Framework\Setup\ModuleDataSetupInterface $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface   $context
     *
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        /** @var \Magento\Eav\Setup\EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        
        $existingAttribute = $eavSetup->getAttributeId(
            Product::ENTITY,
            self::INFOBOX_ATTRIBUTE
        );
        
        if (!$existingAttribute) {
            $eavSetup->addAttribute(
                Product::ENTITY,
                self::INFOBOX_ATTRIBUTE,
                [
                    'group'                   => 'General',
                    'type'                    => Table::TYPE_TEXT,
                    'label'                   => 'Info Box Message',
                    'input'                   => 'text',
                    'class'                   => '',
                    'source'                  => '',
                    'global'                  => ScopedAttributeInterface::SCOPE_GLOBAL,
                    'default'                 => '',
                    'visible'                 => true,
                    'required'                => false,
                    'user_defined'            => false,
                    'searchable'              => false,
                    'filterable'              => false,
                    'comparable'              => false,
                    'visible_on_front'        => true,
                    'unique'                  => false,
                    'used_in_product_listing' => false
                ]
            );
        } else {
            $this->logger->critical(
                'Attribute: '
                . self::INFOBOX_ATTRIBUTE
                . ' already exists in the database.'
            );
            throw new AlreadyExistsException();
        }
    }
}
