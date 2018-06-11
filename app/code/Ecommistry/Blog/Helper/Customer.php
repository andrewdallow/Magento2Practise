<?php

namespace Ecommistry\Blog\Helper;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

/**
 * Class Customer
 *
 * Long description for Class (if any)...
 *
 * @category   Training
 * @package    Training_Blog
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class Customer extends AbstractHelper
{
    /** @var \Magento\Framework\App\Helper\Context */
    private $context;
    /** @var \Magento\Customer\Model\Session */
    private $session;
    
    public function __construct(
        Context $context,
        Session $session
    ) {
        $this->context = $context;
        $this->session = $session;
        parent::__construct($context);
    }
    
    /**
     * Check customer is logged in
     */
    public function checkLoggedIn(): void
    {
        if (!$this->session->isLoggedIn()) {
            $this->session->setAfterAuthUrl(
                $this->context->getUrlBuilder()->getCurrentUrl()
            );
            $this->session->authenticate();
        }
    }
}
