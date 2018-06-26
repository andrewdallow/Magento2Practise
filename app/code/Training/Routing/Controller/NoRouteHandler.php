<?php

namespace Training\Routing\Controller;

use Magento\Framework\App\Router\NoRouteHandlerInterface;

/**
 * Class NoRouteHandler
 *
 * Custom NoRouteHandler which redirects customer to home page.
 *
 * @category   Training
 * @package    Training_Routing
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class NoRouteHandler implements NoRouteHandlerInterface
{
    
    /**
     * Check and process no route request
     *
     * @param \Magento\Framework\App\RequestInterface $request
     *
     * @return bool
     */
    public function process(\Magento\Framework\App\RequestInterface $request)
    {
        $request->setModuleName('cms')
            ->setControllerName('index')
            ->setActionName('index');
        return true;
    }
}
