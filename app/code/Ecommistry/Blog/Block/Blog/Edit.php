<?php

namespace Ecommistry\Blog\Block\Blog;

use Ecommistry\Blog\Model\BlogFactory;
use Ecommistry\Blog\Model\ResourceModel\BlogFactory as BlogResourceFactory;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\View\Element\Template;

/**
 * Edit Block
 *
 * Handles the display of the page for editing a single blog post.
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
class Edit extends Template implements IdentityInterface
{
    private $blogFactory;
    private $blogResourceFactory;
    
    public function __construct(
        Template\Context $context,
        BlogFactory $blogFactory,
        BlogResourceFactory $blogResourceFactory
    ) {
        $this->blogFactory = $blogFactory;
        $this->blogResourceFactory = $blogResourceFactory;
        parent::__construct($context);
    }
    
    /**
     * Get the post specified by the id param.
     *
     * @return \Ecommistry\Blog\Model\Blog
     */
    public function getBlogPost()
    {
        $blog = $this->blogFactory->create();
        $blogId = $this->getRequest()->getParam('id');
        $this->blogResourceFactory->create()
            ->load($blog, $blogId, 'blog_id');
        
        return $blog;
    }
    
    /**
     * @return string
     */
    public function getFormAction()
    {
        if ($this->getRequest()->getParam('id')) {
            return '/blog/index/edit?id=' . $this->getRequest()->getParam('id');
        }
        return '/blog/index/edit';
    }
    
    /**
     * Return unique ID(s) for each object in system
     *
     * @return string[]
     */
    public function getIdentities()
    {
        return $this->getBlogPost()->getIdentities();
    }
}
