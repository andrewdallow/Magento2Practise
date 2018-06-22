<?php

namespace Ecommistry\Blog\Plugin;

use Ecommistry\Blog\Api\BlogRepositoryInterface;
use Ecommistry\Blog\Api\Data\BlogInterface;
use Psr\Log\LoggerInterface;

/**
 * Class SaveBlogLoggerPlugin
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
class SaveBlogLoggerPlugin
{
    /** @var \Psr\Log\LoggerInterface */
    private $logger;
    
    /**
     * SaveBlogLoggerPlugin constructor.
     *
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }
    
    /**
     * @param \Ecommistry\Blog\Api\BlogRepositoryInterface $blogRepository
     * @param \Ecommistry\Blog\Api\Data\BlogInterface      $blog
     */
    public function beforeSave(
        BlogRepositoryInterface $blogRepository,
        BlogInterface $blog
    ) {
        $this->logger->debug('Before Save of ' . $blog->getTitle());
    }
    
    /**
     * @param \Ecommistry\Blog\Api\BlogRepositoryInterface $blogRepository
     * @param \Ecommistry\Blog\Api\Data\BlogInterface      $blog
     * @param \Closure                                     $proceed
     */
    public function aroundSave(
        BlogRepositoryInterface $blogRepository,
        \Closure $proceed,
        BlogInterface $blog
    ) {
        $this->logger->debug('Around Save before call');
        $proceed->call($blogRepository, $blog);
        $this->logger->debug('Around Save after call');
    }
    
    /**
     * @param \Ecommistry\Blog\Api\BlogRepositoryInterface $blogRepository
     * @param \Ecommistry\Blog\Api\Data\BlogInterface      $blog
     */
    public function afterSave(
        BlogRepositoryInterface $blogRepository
    ) {
        $this->logger->debug('After Save');
    }
}
