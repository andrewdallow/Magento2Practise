<?php

namespace Ecommistry\Repository\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class InstallSchema
 *
 * Install customer table into database.
 *
 * @category   Ecommistry
 * @package    Ecommistry_Repository
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class InstallSchema implements InstallSchemaInterface
{
    private const TABLE_NAME = 'ecommistry_customer';
    private const TABLE_ID_FIELD = 'customer_id';
    private const TABLE_INDEX = 'IDX_ECOMMISTRY_CUSTOMER';
    
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
            $setup->getTable(self::TABLE_NAME)
        )->addColumn(
            self::TABLE_ID_FIELD,
            Table::TYPE_INTEGER,
            null,
            [
                'identity' => true,
                'nullable' => false,
                'primary'  => true,
                'unsigned' => true
            ],
            'Customer ID'
        )->addColumn(
            'first_name',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Customer First Name'
        )->addColumn(
            'last_name',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Customer Last Name'
        )->addColumn(
            'address',
            Table::TYPE_TEXT,
            '2M',
            ['nullable' => false],
            'Customer Address'
        )->addColumn(
            'country',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Customer Country'
        )->addIndex(
            self::TABLE_INDEX,
            self::TABLE_ID_FIELD
        )->setComment('Ecommistry Customers');
        
        $setup->getConnection()->createTable($table);
        $setup->endSetup();
    }
}
