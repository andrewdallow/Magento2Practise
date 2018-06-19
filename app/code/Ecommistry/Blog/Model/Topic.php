<?php

namespace Ecommistry\Blog\Model;

use Ecommistry\Blog\Api\Data\TopicInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Model for a Topic
 *
 * @category   Ecommistry
 * @package    Ecommistry_Blog
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class Topic extends AbstractModel implements TopicInterface, IdentityInterface
{
    public const CACHE_TAG = 'ecommistry_topic';
    
    protected function _construct()
    {
        $this->_cacheTag = 'ecommistry_topic';
        $this->_eventPrefix = 'ecommistry_topic';
        $this->_init(ResourceModel\Topic::class);
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
    
    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getData('title');
    }
    
    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->setData('title', $title);
    }
    
    /**
     * @return null|string
     */
    public function getDescription()
    {
        return $this->getData('description');
    }
    
    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->setData('description', $description);
    }
}
