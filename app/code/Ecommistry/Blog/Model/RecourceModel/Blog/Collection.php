<?php

namespace Ecommistry\Blog\Model\RecourceModel\Blog;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Short description for file
 *
 * Long description for file (if any)...
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
class Collection extends AbstractCollection

{
    
    /**
     * Get resource instance.
     *
     * @return \Magento\Framework\Model\ResourceModel\Db\AbstractDb
     */
    public function getResource()
    {
        $this->_init(
            'Ecommistry\Blog\Model\Blog',
            'Ecommistry\Blog\Model\ResourceModel\Blog'
        );
    }
}