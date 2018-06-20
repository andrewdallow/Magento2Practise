<?php

namespace Ecommistry\Blog\Model\ResourceModel\Blog;

use Ecommistry\Blog\Model\Blog;
use Ecommistry\Blog\Model\ResourceModel\Blog as BlogResource;
use Ecommistry\Blog\Setup\InstallSchema;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Blog Collection
 *
 * @category   Ecommistry
 * @package    Ecommistry_Blog
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_idFieldName = InstallSchema::ID_FIELD_NAME;
        $this->_init(Blog::class, BlogResource::class);
    }
}