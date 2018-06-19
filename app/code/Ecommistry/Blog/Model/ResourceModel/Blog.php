<?php

namespace Ecommistry\Blog\Model\ResourceModel;

use Ecommistry\Blog\Setup\InstallSchema;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Blog Resource Model
 *
 * @category   Ecommistry
 * @package    Ecommistry_Blog
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class Blog extends AbstractDb
{
    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            InstallSchema::BLOG_TABLE_NAME,
            InstallSchema::ID_FIELD_NAME
        );
    }
}