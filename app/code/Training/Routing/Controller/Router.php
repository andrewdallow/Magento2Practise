<?php

namespace Training\Routing\Controller;

use Magento\Framework\App\Action\Redirect;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\Router\PathConfigInterface;
use Magento\Framework\App\RouterInterface;
use Magento\Framework\UrlInterface;

/**
 * Class Router Controller
 *
 * Redirect URLs of the form frontName-actionPath-action to
 * frontName/actionPath/action
 *
 * @category   Training
 * @package    Training_Routing
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class Router implements RouterInterface
{
    private const ROUTE_DELIMITER = '-';
    /** @var \Magento\Framework\App\ActionFactory */
    private $actionFactory;
    /** @var \Magento\Framework\App\ResponseInterface */
    private $response;
    /** @var \Magento\Framework\App\Router\PathConfigInterface */
    private $pathConfig;
    /** @var \Magento\Framework\UrlInterface */
    private $url;
    
    /**
     * Router constructor.
     *
     * @param \Magento\Framework\App\ActionFactory              $actionFactory
     * @param \Magento\Framework\App\ResponseInterface          $response
     * @param \Magento\Framework\App\Router\PathConfigInterface $pathConfig
     * @param \Magento\Framework\UrlInterface                   $url
     */
    public function __construct(
        ActionFactory $actionFactory,
        ResponseInterface $response,
        PathConfigInterface $pathConfig,
        UrlInterface $url
    ) {
        $this->response = $response;
        $this->actionFactory = $actionFactory;
        $this->pathConfig = $pathConfig;
        $this->url = $url;
    }
    
    /**
     * Match application action by request
     *
     * @param RequestInterface $request
     *
     * @return ActionInterface
     */
    public function match(RequestInterface $request)
    {
        $url = $this->getRequestUrl($request);
        if ($url) {
            return $this->redirect(
                $request,
                $this->url->getUrl($url)
            );
        }
        return null;
    }
    
    /**
     * Convert Hyphens to forward slashes in the request URL.
     *
     * @param \Magento\Framework\App\RequestInterface $request
     *
     * @return array|bool
     */
    private function getRequestUrl(RequestInterface $request)
    {
        $path = trim($request->getPathInfo(), '/');
        
        $params = explode(
            self::ROUTE_DELIMITER,
            $path ?: $this->pathConfig->getDefaultPath()
        );
        if (count($params) > 1) {
            return implode('/', $params);
        }
        return false;
    }
    
    /**
     * Redirect request to given url.
     *
     * @param \Magento\Framework\App\RequestInterface|HttpRequest $request
     * @param string                                              $url
     *
     * @return ActionInterface
     */
    private function redirect($request, $url)
    {
        $this->response->setRedirect($url);
        $request->setDispatched(true);
        
        return $this->actionFactory->create(Redirect::class);
    }
}
