<?php

namespace Ecommistry\Blog\Block;

use Ecommistry\Blog\Model\ResourceModel\Blog\CollectionFactory;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\View\Element\Template;

/**
 * Blog Block
 *
 * Handles the display of all blog posts on one page.
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
class Blog extends Template implements IdentityInterface
{
    private $blogFactory;
    
    public function __construct(
        Template\Context $context,
        CollectionFactory $blogFactory
    ) {
        $this->blogFactory = $blogFactory;
        parent::__construct($context);
    }
    
    /**
     * @return \Ecommistry\Blog\Model\Blog[]
     */
    public function getPosts()
    {
        $collection = $this->blogFactory->create()->clear();
        $collection->load();
        return $collection->getItems();
    }
    
    /**
     * Return unique ID(s) for each object in system
     *
     * @return string[]
     */
    public function getIdentities()
    {
        $identities = [];
        $posts = $this->getPosts();
        foreach ($posts as $post) {
            $identities[] = $post->getIdentities()[0];
        }
        return $identities;
    }
}