<?php

namespace Ecommistry\Blog\Controller\Adminhtml\Index;

use Ecommistry\Blog\Api\BlogRepositoryInterface;

use Magento\Backend\App\Action;
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
    /** @var \Ecommistry\Blog\Api\BlogRepositoryInterface */
    private $blogRepository;
    
    public function __construct(
        Context $context,
        BlogRepositoryInterface $blogRepository
    ) {
        $this->blogRepository = $blogRepository;
        parent::__construct($context);
    }
    
    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $blogId = $this->getRequest()->getParam('id');
        if ($blogId) {
            try {
                $this->blogRepository->deleteById($blogId);
                $this->messageManager->addSuccessMessage('Blog Post Deleted');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        }
        return $this->resultRedirectFactory->create()
            ->setPath('blog/index/index');
    }
}
