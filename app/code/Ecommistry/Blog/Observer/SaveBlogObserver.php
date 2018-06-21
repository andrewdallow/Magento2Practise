<?php

namespace Ecommistry\Blog\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

/**
 * Class SaveBlogObserver
 *
 * Long description for Class (if any)...
 *
 * @category   Ecommistry
 * @package    Ecommistry_Blog
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class SaveBlogObserver implements ObserverInterface
{
    private $logger;
    
    /**
     * SaveBlogObserver constructor.
     *
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    
    public function execute(Observer $observer)
    {
        $this->logger->debug(
            $observer->getEvent()->getObject()->getTitle()
            . ' Saved to Ecommistry Blog Database.'
        );
    }
}
