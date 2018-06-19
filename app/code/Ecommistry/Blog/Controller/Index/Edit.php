<?php

namespace Ecommistry\Blog\Controller\Index;

use Ecommistry\Blog\Api\BlogRepositoryInterface;
use Ecommistry\Blog\Api\Data\BlogInterface;

use Ecommistry\Blog\Setup\InstallSchema;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

/**
 * Edit Controller
 *
 * Edit a blog post in the database.
 *
 * @category   Ecommistry
 * @package    Ecommistry_Blog
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class Edit extends Action
{
    /** @var \Ecommistry\Blog\Api\BlogRepositoryInterface */
    private $blogRepository;
    /** @var \Magento\Customer\Model\Session */
    private $session;
    
    public function __construct(
        Context $context,
        BlogRepositoryInterface $blogRepository,
        Session $session
    ) {
        $this->session = $session;
        $this->blogRepository = $blogRepository;
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
            $blog
                = $this->getBlogById((int)$post[InstallSchema::ID_FIELD_NAME]);
            $this->updateBlog($blog);
        }
    }
    
    /**
     * @param int $id
     *
     * @return \Ecommistry\Blog\Api\Data\BlogInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    private function getBlogById(int $id): BlogInterface
    {
        return $this->blogRepository->getById($id);
    }
    
    /**
     * @param \Ecommistry\Blog\Api\Data\BlogInterface $blog
     * @param array                                   $post
     */
    private function updateBlog(BlogInterface $blog)
    {
        $blog->setData($this->getRequest()->getParams());
        $blog->setUpdatedTime();
        
        try {
            $this->blogRepository->save($blog);
            $this->messageManager->addSuccessMessage('Blog Post Updated');
        } catch (\Exception $alreadyExistsException) {
            $this->messageManager->addErrorMessage('Something went wrong');
        }
    }
}
