<?php

namespace Training\ExtAttribute\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Training\ExtAttribute\Api\Data\Category\CountryInterface;

/**
 * Class InstallSchema
 *
 * Category Country Table install.
 *
 * @category   Training
 * @package    Training_ExtAttribute
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class InstallSchema implements InstallSchemaInterface
{
    public const ID_FIELD = 'id';
    public const COUNTRY_TABLE_NAME = 'training_category_country';
    
    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface   $setup
     * @param ModuleContextInterface $context
     *
     * @return void
     * @throws \Zend_Db_Exception
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();
        
        $table = $setup->getConnection()->newTable(
            $setup->getTable(self::COUNTRY_TABLE_NAME)
        )->addColumn(
            self::ID_FIELD,
            Table::TYPE_SMALLINT,
            null,
            [
                'identity' => true,
                'nullable' => false,
                'primary'  => true,
                'unsigned' =>
                    true
            ],
            'Category Country ID'
        )->addColumn(
            CountryInterface::COUNTRY_CATEGORY_ID,
            Table::TYPE_SMALLINT,
            null,
            [
                'nullable' => false,
                'unsigned' => true
            ],
            'Category ID'
        )->addColumn(
            CountryInterface::COUNTRY_NAME,
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Country Name'
        )->addIndex(
            'IDX_CATEGORY_COUNTRY_ID_COLUMN',
            self::ID_FIELD
        );
        $setup->getConnection()->createTable($table);
        $setup->endSetup();
    }
}
