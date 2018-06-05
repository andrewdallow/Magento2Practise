<?php

namespace Ecommistry\Blog\Controller\Index;

use Ecommistry\Blog\Model\Blog;
use Ecommistry\Blog\Model\BlogFactory;
use Ecommistry\Blog\Model\ResourceModel\BlogFactory as BlogResourceFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;

/**
 * Delete Controller
 *
 * Delete a blog post from the database.
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
class Delete extends Action
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
        $blogId = $this->getRequest()->getParam('id');
        try {
            $blog = $this->blogFactory->create();
            $this->blogResourceFactory->create()
                ->load($blog, $blogId, 'blog_id');
            $this->blogResourceFactory->create()->delete($blog);
            $this->messageManager->addSuccessMessage('Blog Post Deleted');
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }
        $this->_redirect('blog');
    }
}
