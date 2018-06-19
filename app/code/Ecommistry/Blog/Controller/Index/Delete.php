<?php

namespace Ecommistry\Blog\Controller\Index;

use Ecommistry\Blog\Api\BlogRepositoryInterface;

use Ecommistry\Blog\Setup\InstallSchema;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

/**
 * Delete Controller
 *
 * Delete a blog post from the database.
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
    
            $blogId = $this->getRequest()
                ->getParam(InstallSchema::ID_FIELD_NAME);
            if ($blogId) {
                try {
                    $this->blogRepository->deleteById((int)$blogId);
                    $this->messageManager->addSuccessMessage('Blog Post Deleted');
                } catch (\Exception $e) {
                    $this->messageManager->addErrorMessage($e->getMessage());
                }
            }
        }
        return $result;
    }
}
