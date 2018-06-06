<?php

namespace Ecommistry\Blog\Model;

use Ecommistry\Blog\Model\Api\Data\BlogWithTopicInterface;
use Ecommistry\Blog\Model\Api\Data\UpdatableInterface;

/**
 * Model For a Blog With a Topic
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
class BlogWithTopic extends Blog implements
    BlogWithTopicInterface,
    UpdatableInterface
{
    /**
     * @return mixed
     */
    public function getTopicId()
    {
        return $this->getData('topic_id');
    }
    
    /**
     * @param $id
     */
    public function setTopicId($id)
    {
        $this->setData('topic_id', $id);
    }
    
    /**
     * @return mixed
     */
    public function getUpdatedTime()
    {
        return $this->getData('updated_time');
    }
    
    public function setUpdatedTime()
    {
        $this->setData('updated_time', date('d-m-Y h:i:s a'));
    }
}
