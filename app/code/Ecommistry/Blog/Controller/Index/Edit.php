<?php

namespace Ecommistry\Blog\Controller\Index;

use Ecommistry\Blog\Model\Blog;
use Ecommistry\Blog\Model\BlogFactory;
use Ecommistry\Blog\Model\ResourceModel\BlogFactory as BlogResourceFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
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
    private $blogFactory;
    private $blogResourceFactory;
    
    public function __construct(
        Context $context,
        BlogFactory $blogFactory,
        BlogResourceFactory $blogResourceFactory
    ) {
        $this->blogFactory = $blogFactory;
        $this->blogResourceFactory = $blogResourceFactory;
        parent::__construct($context);
    }
    
    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $this->updateBlogIfPost();
        
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
    
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
     * @return \Ecommistry\Blog\Model\Blog
     */
    private function getBlogById(string $id): Blog
    {
        $blog = $this->blogFactory->create();
        $this->blogResourceFactory->create()->load($blog, $id, 'blog_id');
        return $blog;
    }
    
    /**
     * @param \Ecommistry\Blog\Model\Blog $blog
     * @param array                       $post
     *
     * @throws \Exception
     */
    private function updateBlog(Blog $blog, array $post)
    {
        $blog->setTitle($post['title']);
        $blog->setContent($post['content']);
        try {
            $this->blogResourceFactory->create()->save($blog);
            $this->messageManager->addSuccessMessage('Blog Post Updated');
        } catch (\Exception $alreadyExistsException) {
            $this->messageManager->addErrorMessage('Something went wrong');
        }
        
    }
    
    
}
