<?php

namespace Ecommistry\Blog\Api\Data\BlogInterface;

use Ecommistry\Blog\Api\Data\BlogInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\ObjectManager\NoninterceptableInterface;
use Magento\Framework\ObjectManagerInterface;

/**
 * Class Proxy
 *
 * Long description for Class (if any)...
 *
 * @category   Ecommistry
 * @package    Ecommistry_Blog
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class Proxy implements
    BlogInterface,
    NoninterceptableInterface,
    IdentityInterface
{
    /** @var \Magento\Framework\ObjectManagerInterface */
    private $objectManager;
    /** @var string */
    private $blogInstanceName;
    /** @var \Ecommistry\Blog\Api\Data\BlogInterface */
    private $blogSubject;
    /** @var bool */
    private $isShared;
    
    /**
     * Proxy constructor.
     *
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param string                                    $instanceName
     * @param bool                                      $shared
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        $instanceName = BlogInterface::class,
        $shared = true
    ) {
        $this->objectManager = $objectManager;
        $this->blogInstanceName = $instanceName;
        $this->isShared = $shared;
    }
    
    /**
     * @return array
     */
    public function __sleep()
    {
        return ['blogSubject', 'isShared', 'blogInstanceName'];
    }
    
    /**
     * Retrieve ObjectManager from global scope
     */
    public function __wakeup()
    {
        $this->objectManager
            = \Magento\Framework\App\ObjectManager::getInstance();
    }
    
    /**
     * Clone proxied instance
     */
    public function __clone()
    {
        $this->blogSubject = clone $this->getBlogSubject();
    }
    
    /**
     *  Get Proxy blog instance.
     *
     * @return \Ecommistry\Blog\Api\Data\BlogInterface
     */
    private function getBlogSubject()
    {
        if (!$this->blogSubject) {
            if ($this->isShared) {
                $this->blogSubject = $this->objectManager
                    ->get($this->blogInstanceName);
            } else {
                $this->blogSubject = $this->objectManager
                    ->create($this->blogInstanceName);
            }
        }
        return $this->blogSubject;
    }
    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->getBlogSubject()->getId();
    }
    
    /**
     * @param int $value
     *
     * @return void
     */
    public function setId($value)
    {
        $this->getBlogSubject()->setId($value);
    }
    
    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getBlogSubject()->getTitle();
    }
    
    /**
     * @param string $title
     *
     * @return void
     */
    public function setTitle($title)
    {
        $this->getBlogSubject()->setTitle($title);
    }
    
    /**
     * @return string
     */
    public function getContent()
    {
        return $this->getBlogSubject()->getContent();
    }
    
    /**
     * @param string $content
     *
     * @return void
     */
    public function setContent($content)
    {
        $this->getBlogSubject()->setContent($content);
    }
    
    /**
     * @return string
     */
    public function getCreationTime()
    {
        return $this->getBlogSubject()->getCreationTime();
    }
    
    /**
     * @return void
     */
    public function setCreationTime()
    {
        $this->getBlogSubject()->setCreationTime();
    }
    
    /**
     * @return int
     */
    public function getTopicId()
    {
        return $this->getBlogSubject()->getTopicId();
    }
    
    /**
     * @param int $id
     *
     * @return void
     */
    public function setTopicId($id)
    {
        $this->getBlogSubject()->setTopicId($id);
    }
    
    /**
     * @return string
     */
    public function getUpdatedTime()
    {
        return $this->getBlogSubject()->getUpdatedTime();
    }
    
    /**
     * @return void
     */
    public function setUpdatedTime()
    {
        $this->getBlogSubject()->setUpdatedTime();
    }
    
    /**
     * Return unique ID(s) for each object in system
     *
     * @return string[]
     */
    public function getIdentities()
    {
        return $this->getBlogSubject()->getIdentities();
    }
}
