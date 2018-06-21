<?php

namespace Ecommistry\Blog\Cron;

use Ecommistry\Blog\Api\BlogRepositoryInterface;
use Ecommistry\Blog\Api\Data\BlogInterfaceFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Psr\Log\LoggerInterface;

/**
 * Class AddPost Cron
 *
 * Add a Blog Post to the database.
 *
 * @category   Ecommistry
 * @package    Ecommistry_Blog
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class AddPost
{
    private const XML_PATH_ENABLED = 'blogs/settings/isEnabled';
    /** @var \Ecommistry\Blog\Api\Data\BlogInterfaceFactory */
    private $blogFactory;
    /** @var \Ecommistry\Blog\Api\BlogRepositoryInterface */
    private $blogRepository;
    /** @var \Magento\Framework\App\Config\ScopeConfigInterface */
    private $config;
    
    public function __construct(
        BlogInterfaceFactory $blogFactory,
        BlogRepositoryInterface $blogRepository,
        ScopeConfigInterface $config
    ) {
        $this->blogFactory = $blogFactory;
        $this->blogRepository = $blogRepository;
        $this->config = $config;
    }
    
    /**
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function execute()
    {
        $isEnabled = $this->config->getValue(self::XML_PATH_ENABLED);
        
        if ($isEnabled) {
            $blog = $this->blogFactory->create();
            $blog->setTitle('Cron Blog Addition');
            $blog->setTopicId(1);
            $blog->setContent('Added via Cron at ' . time());
            
            $this->blogRepository->save($blog);
        }
    }
}
