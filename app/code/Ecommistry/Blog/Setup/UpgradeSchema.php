<?php

namespace Ecommistry\Blog\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

/**
 * Upgrade Database
 *
 * @category   Zend
 * @package    Zend_Ecommistry
 * @subpackage Blog
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    
    /**
     * @param \Magento\Framework\Setup\SchemaSetupInterface   $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     *
     * @throws \Zend_Db_Exception
     */
    public function upgrade(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();
        
        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $table = $setup->getConnection()->newTable(
                $setup->getTable('ecommistry_topic')
            )->addColumn(
                'topic_id',
                Table::TYPE_SMALLINT,
                null,
                [
                    'identity' => true,
                    'nullable' => false,
                    'primary'  => true,
                    'unsigned' => true
                ],
                'Topic ID'
            )->addColumn(
                'title',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Topic Title'
            )->addColumn(
                'description',
                Table::TYPE_TEXT,
                '2M',
                [],
                'Blog Description'
            )->addColumn(
                'creation_time',
                Table::TYPE_TIMESTAMP,
                null,
                [
                    'nullable' => false,
                    'default'  => Table::TIMESTAMP_INIT
                ],
                'Topic Creation Time'
            );
            $setup->getConnection()->createTable($table);
            
            $setup->getConnection()->addColumn(
                $setup->getTable('ecommistry_blog'),
                'updated_time',
                [
                    'type'     => Table::TYPE_TIMESTAMP,
                    'default'  => Table::TIMESTAMP_INIT,
                    'nullable' => false,
                    'comment'  => 'Blog Updated Time'
                ]
            );
            
            $setup->getConnection()->addColumn(
                $setup->getTable('ecommistry_blog'),
                'topic_id',
                [
                    'type'     => Table::TYPE_SMALLINT,
                    'nullable' => false,
                    'comment'  => 'Blog Topic ID'
                ]
            );
        }
        $setup->endSetup();
    }
}
