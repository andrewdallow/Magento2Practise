<?php

namespace Ecommistry\Blog\Controller\Adminhtml\Index;

use Ecommistry\Blog\Api\BlogRepositoryInterface;
use Ecommistry\Blog\Model\BlogFactory;
use Ecommistry\Blog\Model\ResourceModel\BlogFactory as BlogResourceFactory;
use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use \Magento\Backend\App\Action\Context;

/**
 * Class Save
 *
 * Save Blog post to database.
 *
 * @category   Ecommistry
 * @package    Ecommistry_Blog
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class Save extends Action
{
    
    private $blogFactory;
    private $blogRepository;
    
    public function __construct(
        Context $context,
        BlogFactory $itemFactory,
        BlogRepositoryInterface $blogRepository
    ) {
        $this->blogFactory = $itemFactory;
        $this->blogRepository = $blogRepository;
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
        try {
            $blog = $this->blogFactory->create()
                ->setData($this->getRequest()->getPostValue());
            $this->blogRepository->save($blog);
            $this->messageManager->addSuccessMessage('Blog Post Saved');
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage('Something went wrong');
        }
        
        return $this->resultRedirectFactory->create()
            ->setPath('blog/index/index');
    }
}
