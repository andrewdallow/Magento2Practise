<?php

namespace Training\Routing\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\RouterList;
use Psr\Log\LoggerInterface;

/**
 * Class RouterLogger
 *
 * Long description for Class (if any)...
 *
 * @category   Training
 * @package    Training_Routing
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class Index extends Action
{
    
    private $logger;
    private $routerList;
    
    public function __construct(
        Context $context,
        LoggerInterface $logger,
        RouterList $routerList
    ) {
        $this->logger = $logger;
        $this->routerList = $routerList;
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
        echo '<h1>List of All Routers in RouterList Class</h1>';
        print_r($this->getRouterList());
        die('Routers Printed');
    }
    
    /**
     * @return string
     */
    private function getRouterList()
    {
        $list = '';
        foreach ($this->routerList as $router) {
            $className = \get_class($router);
            $this->logger->debug("Router: $className");
            $list .= '<p>' . \get_class($router) . "</p>";
        }
        return $list;
    }
}
