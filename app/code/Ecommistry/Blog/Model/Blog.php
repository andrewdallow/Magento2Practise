<?php

namespace Ecommistry\Blog\Model;

/**
 * Blog Model
 *
 * Model representing a single blog post.
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
class Blog extends AbstractBlog
{
    public const CACHE_TAG = 'ecommistry_blog';
    
    protected function _construct()
    {
        $this->_cacheTag = 'ecommistry_blog';
        $this->_eventPrefix = 'ecommistry_blog';
        $this->_init(ResourceModel\Blog::class);
    }
    
    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->getData('title');
    }
    
    /**
     * @param $title
     */
    public function setTitle($title)
    {
        $this->setData('title', $title);
    }
    
    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->getData('content');
    }
    
    /**
     * @param $content
     */
    public function setContent($content)
    {
        $this->setData('content', $content);
    }
    
    /**
     * @return mixed
     */
    public function getCreationTime()
    {
        return $this->getData('creation_time');
    }
    
    public function setCreationTime()
    {
        $this->setData('creation_time', date('d-m-Y h:i:s a'));
    }
    
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
    
    /**
     * Return unique ID(s) for each object in system
     *
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}