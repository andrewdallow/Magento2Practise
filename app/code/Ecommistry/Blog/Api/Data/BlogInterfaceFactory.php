<?php

namespace Ecommistry\Blog\Api\Data;

use Ecommistry\Blog\Api\Data\BlogInterface;
use Magento\Framework\ObjectManagerInterface;

/**
 * Class BlogFactory
 *
 * Create the concrete Blog Entity.
 *
 * @category   Ecommistry
 * @package    Ecommistry_Blog
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class BlogInterfaceFactory
{
    /** @var \Magento\Framework\ObjectManagerInterface */
    private $objectManager;
    /** @var string */
    private $blogInstanceName;
    
    public function __construct(
        ObjectManagerInterface $objectManager,
        $instanceName = BlogInterface::class
    ) {
        $this->objectManager = $objectManager;
        $this->blogInstanceName = $instanceName;
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
        return $this->objectManager->create($this->blogInstanceName, $data);
    }
    
}
