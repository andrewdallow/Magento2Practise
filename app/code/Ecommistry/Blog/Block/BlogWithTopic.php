<?php

namespace Ecommistry\Blog\Block;

use Ecommistry\Blog\Model\ResourceModel\Blog\CollectionFactory as BlogCollectionFactory;
use Ecommistry\Blog\Model\ResourceModel\Topic\CollectionFactory as TopicCollectionFactory;
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
class BlogWithTopic extends Blog
{
    private $topicCollectionFactory;
    
    public function __construct(
        Context $context,
        BlogCollectionFactory $blogFactory,
        TopicCollectionFactory $topicCollectionFactory
    ) {
        $this->topicCollectionFactory = $topicCollectionFactory;
        parent::__construct($context, $blogFactory);
    }
    
    public function getTopicById($id)
    {
        return $this->topicCollectionFactory->create()->getItemById($id);
    }
    
}
