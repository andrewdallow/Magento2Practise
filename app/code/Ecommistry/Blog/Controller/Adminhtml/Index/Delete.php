<?php

namespace Ecommistry\Blog\Controller\Adminhtml\Index;

use Ecommistry\Blog\Model\BlogFactory;
use Ecommistry\Blog\Model\ResourceModel\BlogFactory as BlogResourceFactory;
use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use \Magento\Backend\App\Action\Context;

/**
 * Class Delete Controller
 *
 * Delete a Blog Post
 *
 * @category   Ecommistry
 * @package    Ecommistry_Blog
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class Delete extends Action
{
    private $blogFactory;
    private $resourceFactory;
    
    public function __construct(
        Context $context,
        BlogFactory $blogFactory,
        BlogResourceFactory $resourceFactory
    ) {
        $this->blogFactory = $blogFactory;
        $this->resourceFactory = $resourceFactory;
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
        
        if ($blogId) {
            try {
                $blog = $this->blogFactory->create();
                $this->resourceFactory->create()
                    ->load($blog, $blogId, 'blog_id');
                $this->resourceFactory->create()->delete($blog);
                $this->messageManager->addSuccessMessage('Blog Post Deleted');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        }
        return $this->resultRedirectFactory->create()
            ->setPath('blog/index/index');
    }
}
