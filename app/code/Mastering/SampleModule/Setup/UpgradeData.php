<?php
/**
 * Short description for file
 *
 * Long description for file (if any)...
 *
 * @category   Zend
 * @package    Zend_Mastering
 * @subpackage SampleModule
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */

namespace Mastering\SampleModule\Setup;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

class UpgradeData implements UpgradeDataInterface
{
    
    public function upgrade(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();
        
        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $setup->getConnection()->update(
                $setup->getTable('mastering_sample_item'),
                [
                    'description' => 'Default Description'
                ],
                $setup->getConnection()->quoteInto('id= ?', 1)
            );
            
            $setup->endSetup();
        }
    }
}