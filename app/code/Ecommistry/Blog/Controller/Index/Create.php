<?php

namespace Ecommistry\Blog\Controller\Index;

use Ecommistry\Blog\Api\BlogRepositoryInterface;
use Ecommistry\Blog\Model\Blog;
use Ecommistry\Blog\Model\BlogFactory;
use Ecommistry\Blog\Setup\InstallSchema;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\AlreadyExistsException;

/**
 * Create Controller
 *
 * Create a blog entry in the database from POST data.
 *
 * @category   Ecommistry
 * @package    Ecommistry_Blog
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class Create extends Action
{
    /** @var \Ecommistry\Blog\Model\BlogFactory */
    private $blogFactory;
    /** @var \Ecommistry\Blog\Api\BlogRepositoryInterface */
    private $blogRepository;
    /** @var \Magento\Customer\Model\Session */
    private $session;
    
    public function __construct(
        Context $context,
        BlogFactory $blogFactory,
        BlogRepositoryInterface $blogRepository,
        Session $session
    ) {
        $this->session = $session;
        $this->blogRepository = $blogRepository;
        $this->blogFactory = $blogFactory;
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
        if (!$this->session->isLoggedIn()) {
            $result
                = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $result->setPath('*/*/message');
        } else {
            $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
            $this->createNewBlogIfPost();
        }
        
        return $result;
    }
    
    private function createNewBlogIfPost(): void
    {
        $post = (array)$this->getRequest()->getParams();
        
        if (isset($post['submit'])) {
            $blog = $this->getBlog($post);
            $this->saveBlog($blog);
            $this->_redirect(
                'blog/index/edit',
                [InstallSchema::ID_FIELD_NAME => $blog->getId()]
            );
        }
    }
    
    /**
     * @param array $post
     *
     * @return \Ecommistry\Blog\Model\Blog
     */
    private function getBlog(array $post): Blog
    {
        $blog = $this->blogFactory->create();
        $blog->setData($post);
        return $blog;
    }
    
    /**
     * @param \Ecommistry\Blog\Model\Blog $blog
     */
    private function saveBlog(Blog $blog): void
    {
        try {
            $this->blogRepository->save($blog);
            $this->messageManager->addSuccessMessage('Blog Post Added');
        } catch (AlreadyExistsException $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
        }
    }
}
