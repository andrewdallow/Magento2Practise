<?php

namespace Ecommistry\Blog\Api\Data\TopicInterface;

use Ecommistry\Blog\Api\Data\TopicInterface;
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
class Proxy implements TopicInterface, NoninterceptableInterface
{
    /** @var \Magento\Framework\ObjectManagerInterface */
    private $objectManager;
    /** @var string */
    private $topicInstanceName;
    /** @var \Ecommistry\Blog\Api\Data\TopicInterface */
    private $topicSubject;
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
        $instanceName = TopicInterface::class,
        $shared = true
    ) {
        $this->objectManager = $objectManager;
        $this->topicInstanceName = $instanceName;
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
        $this->topicSubject = clone $this->getTopicSubject();
    }
    
    /**
     *  Get Proxy topic instance.
     *
     * @return \Ecommistry\Blog\Api\Data\TopicInterface
     */
    private function getTopicSubject()
    {
        if (!$this->topicSubject) {
            if ($this->isShared) {
                $this->topicSubject = $this->objectManager
                    ->get($this->topicInstanceName);
            } else {
                $this->topicSubject = $this->objectManager
                    ->create($this->topicInstanceName);
            }
        }
        return $this->topicSubject;
    }
    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->getTopicSubject()->getId();
    }
    
    /**
     * @param int $id
     *
     * @return void
     */
    public function setId($id)
    {
        $this->getTopicSubject()->setId($id);
    }
    
    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getTopicSubject()->getTitle();
    }
    
    /**
     * @param string $title
     *
     * @return void
     */
    public function setTitle($title)
    {
        $this->getTopicSubject()->setTitle($title);
    }
    
    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->getTopicSubject()->getDescription();
    }
    
    /**
     * @param string $description
     *
     * @return void
     */
    public function setDescription($description)
    {
        $this->getTopicSubject()->setDescription($description);
    }
}
