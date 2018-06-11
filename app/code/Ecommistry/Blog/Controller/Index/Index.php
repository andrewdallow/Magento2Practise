<?php

namespace Ecommistry\Blog\Controller\Index;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;

/**
 * Index Controller
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
class Index extends Action
{
    /** @var \Ecommistry\Blog\Helper\Customer */
    private $customerHelper;
    /** @var \Magento\Customer\Model\Session */
    private $session;
    
    public function __construct(
        Context $context,
        Session $session
    ) {
        $this->session = $session;
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
        }
        return $result;
    }
    
    
}
