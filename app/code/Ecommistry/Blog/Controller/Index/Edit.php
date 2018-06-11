<?php

namespace Ecommistry\Blog\Controller\Index;

use Ecommistry\Blog\Model\BlogWithTopic;
use Ecommistry\Blog\Model\BlogWithTopicFactory;
use Ecommistry\Blog\Model\ResourceModel\BlogFactory as BlogResourceFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

/**
 * Edit Controller
 *
 * Edit a blog post in the database.
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
class Edit extends Action
{
    /** @var \Ecommistry\Blog\Model\BlogWithTopicFactory */
    private $blogFactory;
    /** @var \Ecommistry\Blog\Model\ResourceModel\BlogFactory */
    private $blogResourceFactory;
    /** @var \Magento\Customer\Model\Session */
    private $session;
    
    public function __construct(
        Context $context,
        BlogWithTopicFactory $blogFactory,
        BlogResourceFactory $blogResourceFactory,
        Session $session
    ) {
        $this->session = $session;
        $this->blogFactory = $blogFactory;
        $this->blogResourceFactory = $blogResourceFactory;
        parent::__construct($context);
    }
    
    /**
     * @return \Magento\Framework\Controller\ResultInterface
     * @throws \Exception
     */
    public function execute()
    {
        if (!$this->session->isLoggedIn()) {
            $result
                = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $result->setPath('*/*/message');
        } else {
            $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
            $this->updateBlogIfPost();
        }
        return $result;
    }
    
    /**
     * @throws \Exception
     */
    private function updateBlogIfPost()
    {
        $post = (array)$this->getRequest()->getParams();
        
        if (isset($post['submit'])) {
            $blog = $this->getBlogById($post['id']);
            $this->updateBlog($blog, $post);
        }
    }
    
    /**
     * @param string $id
     *
     * @return \Ecommistry\Blog\Model\BlogWithTopic
     */
    private function getBlogById(string $id): BlogWithTopic
    {
        $blog = $this->blogFactory->create();
        $this->blogResourceFactory->create()->load($blog, $id, 'blog_id');
        return $blog;
    }
    
    /**
     * @param \Ecommistry\Blog\Model\BlogWithTopic $blog
     * @param array                                $post
     *
     * @throws \Exception
     */
    private function updateBlog(BlogWithTopic $blog, array $post)
    {
        $blog->setTitle($post['title']);
        $blog->setContent($post['content']);
        $blog->setTopicId($post['topic']);
        $blog->setUpdatedTime();
        
        try {
            $this->blogResourceFactory->create()->save($blog);
            $this->messageManager->addSuccessMessage('Blog Post Updated');
        } catch (\Exception $alreadyExistsException) {
            $this->messageManager->addErrorMessage('Something went wrong');
        }
    }
}
