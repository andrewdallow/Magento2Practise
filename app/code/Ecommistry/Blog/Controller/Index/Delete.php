<?php

namespace Ecommistry\Blog\Controller\Index;

use Ecommistry\Blog\Model\BlogFactory;
use Ecommistry\Blog\Model\ResourceModel\BlogFactory as BlogResourceFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

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
    /** @var \Ecommistry\Blog\Model\BlogFactory */
    private $blogFactory;
    /** @var \Ecommistry\Blog\Model\ResourceModel\BlogFactory */
    private $blogResourceFactory;
    /** @var \Magento\Customer\Model\Session */
    private $session;
    
    public function __construct(
        Context $context,
        BlogFactory $blogFactory,
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
     */
    public function execute()
    {
        if (!$this->session->isLoggedIn()) {
            $result
                = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $result->setPath('*/*/message');
        } else {
            $result
                = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $result->setUrl('/blog');
        
            $blogId = $this->getRequest()->getParam('id');
            if ($blogId) {
                try {
                    $blog = $this->blogFactory->create();
                    $this->blogResourceFactory->create()
                        ->load($blog, $blogId, 'blog_id');
                    $this->blogResourceFactory->create()->delete($blog);
                    $this->messageManager->addSuccessMessage('Blog Post Deleted');
                } catch (\Exception $e) {
                    $this->messageManager->addErrorMessage($e->getMessage());
                }
            }
        }
        return $result;
    }
}
