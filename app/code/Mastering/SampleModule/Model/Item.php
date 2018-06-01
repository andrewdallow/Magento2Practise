<?php
namespace Mastering\SampleModule\Model;

use Magento\Framework\Model\AbstractExtensibleModel;

/**
 * Item Model
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
class Item extends AbstractExtensibleModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel\Item::class);
    }
}