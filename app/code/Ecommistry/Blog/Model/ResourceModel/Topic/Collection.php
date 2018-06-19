<?php

namespace Ecommistry\Blog\Model\ResourceModel\Topic;

use Ecommistry\Blog\Model\ResourceModel\Topic as TopicResource;
use Ecommistry\Blog\Model\Topic;
use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Collection of Topics
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
        $this->_idFieldName = 'topic_id';
        $this->_init(Topic::class, TopicResource::class);
    }
}
