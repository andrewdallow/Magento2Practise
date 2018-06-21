<?php

namespace Ecommistry\Blog\Api\Data;

use Ecommistry\Blog\Api\Data\TopicInterface;
use Magento\Framework\ObjectManagerInterface;

/**
 * Class TopicInterfaceFactory
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
class TopicInterfaceFactory
{
    /** @var \Magento\Framework\ObjectManagerInterface */
    private $objectManager;
    /** @var string */
    private $topicInstanceName;
    
    public function __construct(
        ObjectManagerInterface $objectManager,
        $instanceName = TopicInterface::class
    ) {
        $this->objectManager = $objectManager;
        $this->topicInstanceName = $instanceName;
    }
    
    /**
     * Create Blog Intance
     *
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data = [])
    {
        return $this->objectManager->create($this->topicInstanceName, $data);
    }
}
