<?php

namespace Ecommistry\Blog\Model;

use Ecommistry\Blog\Api\Data\BlogInterface;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class BlogRegistry
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
class BlogRegistry
{
    /** @var array */
    private $registry = [];
    /** @var \Ecommistry\Blog\Model\Blog */
    private $blogFactory;
    
    public function __construct(
        BlogFactory $blogFactory
    
    ) {
        $this->blogFactory = $blogFactory;
    }
    
    /**
     * Get instance of the Demo Model identified by an id
     *
     * @param $blogId
     *
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function retrieve($blogId)
    {
        if (isset($this->registry[$blogId])) {
            return $this->registry[$blogId];
        }
        
        $blog = $this->blogFactory->create();
        $blog->load($blogId);
        
        if ($blog->getId() === null || $blog->getId() !== $blogId) {
            throw NoSuchEntityException::singleField(
                BlogInterface::class,
                $blogId
            );
        }
        
        $this->registry[$blogId] = $blog;
        
        return $blog;
    }
}
