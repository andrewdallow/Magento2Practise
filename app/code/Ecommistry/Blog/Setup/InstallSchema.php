<?php

namespace Ecommistry\Blog\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class InstallSchema
 *
 * Install script to install the ecommistry blog table
 *
 * @category   Zend
 * @package    Zend_Training
 * @subpackage SimpleGreeter
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class InstallSchema implements InstallSchemaInterface
{
    public const ID_FIELD_NAME = 'blog_id';
    public const BLOG_TABLE_NAME = 'ecommistry_blog';
    /**
     * @param \Magento\Framework\Setup\SchemaSetupInterface   $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     *
     * @throws \Zend_Db_Exception
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        
        $installer->startSetup();
        
        $table = $installer->getConnection()->newTable(
            $installer->getTable(self::BLOG_TABLE_NAME)
        )->addColumn(
            self::ID_FIELD_NAME,
            Table::TYPE_SMALLINT,
            null,
            [
                'identity' => true,
                'nullable' => false,
                'primary'  => true,
                'unsigned' =>
                    true
            ],
            'Blog ID'
        )->addColumn(
            'title',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Blog Title'
        )->addColumn(
            'content',
            Table::TYPE_TEXT,
            '2M',
            [],
            'Blog Content'
        )->addColumn(
            'creation_time',
            Table::TYPE_TIMESTAMP,
            null,
            [
                'nullable' => false,
                'default'  =>
                    Table::TIMESTAMP_INIT
            ],
            'Blog Creation Time'
        )->setComment(
            'Ecommistry Blog Table'
        );
        
        $installer->getConnection()->createTable($table);
        $installer->endSetup();
    }
}
