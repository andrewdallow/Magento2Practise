<?php

namespace Ecommistry\Blog\Model;

use Ecommistry\Blog\Model\Api\Data\TopicInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

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
class Topic extends AbstractModel implements TopicInterface, IdentityInterface
{
    const CACHE_TAG = 'ecommistry_topic';
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
        return $this->getData('title');
    }
    
    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        // TODO: Implement setTitle() method.
    }
    
    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        // TODO: Implement getDescription() method.
    }
    
    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        // TODO: Implement setDescription() method.
    }
}
