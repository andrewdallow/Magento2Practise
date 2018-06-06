<?php

namespace Ecommistry\Blog\Block\Blog;

use Ecommistry\Blog\Model\BlogFactory;
use Ecommistry\Blog\Model\ResourceModel\Blog\CollectionFactory as BlogCollectionFactory;
use Ecommistry\Blog\Model\ResourceModel\Topic\CollectionFactory as TopicCollectionFactory;
use Ecommistry\Blog\Model\ResourceModel\BlogFactory as BlogResourceFactory;
use Magento\Framework\View\Element\Template\Context;

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
class EditWithTopics extends Edit
{
    private $topicsFactory;
    
    public function __construct(
        Context $context,
        BlogFactory $blogFactory,
        BlogResourceFactory $blogResourceFactory,
        TopicCollectionFactory $topicCollectionFactory
    ) {
        $this->topicsFactory = $topicCollectionFactory;
        parent::__construct($context, $blogFactory, $blogResourceFactory);
    }
    
    public function getTopics()
    {
        return $this->topicsFactory->create()->getItems();
    }
}
