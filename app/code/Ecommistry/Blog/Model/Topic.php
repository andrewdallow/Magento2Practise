<?php

namespace Ecommistry\Blog\Model;

use Ecommistry\Blog\Model\Api\Data\TopicInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Model for a Topic
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
class Topic extends AbstractModel implements TopicInterface, IdentityInterface
{
    const CACHE_TAG = 'ecommistry_topic';
    const TOPIC_TITLE = 'title';
    const TOPIC_DESCRIPTION = 'description';
    
    protected $_cacheTag = 'ecommistry_topic';
    protected $_eventPrefix = 'ecommistry_topic';
    
    
    protected function _construct()
    {
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
    
    
    public function getTitle()
    {
        return $this->getData(self::TOPIC_TITLE);
    }
    
    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->setData(self::TOPIC_TITLE, $title);
    }
    
    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->getData(self::TOPIC_DESCRIPTION);
    }
    
    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->setData(self::TOPIC_DESCRIPTION, $description);
    }
}
