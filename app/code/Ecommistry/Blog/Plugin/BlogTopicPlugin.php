<?php

namespace Ecommistry\Blog\Plugin;

use Ecommistry\Blog\Api\BlogRepositoryInterface;
use Ecommistry\Blog\Api\Data\BlogInterface;
use Ecommistry\Blog\Api\Data\BlogSearchResultInterface;
use Ecommistry\Blog\Api\TopicRepositoryInterface;
use \Ecommistry\Blog\Api\Data\BlogExtensionInterfaceFactory;

use Magento\Framework\Exception\NoSuchEntityException;
use Psr\Log\LoggerInterface;

/**
 * Class BlogTopicPlugin
 *
 * Set topic Extension attributes for the Blog entity.
 *
 * @category   Ecommistry
 * @package    Ecommistry_Blog
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class BlogTopicPlugin
{
    /** @var \Ecommistry\Blog\Api\TopicRepositoryInterface */
    private $topicRepository;
    private $extensionFactory;
    /** @var \Psr\Log\LoggerInterface */
    private $logger;
    
    public function __construct(
        TopicRepositoryInterface $topicRepository,
        BlogExtensionInterfaceFactory $extensionFactory,
        LoggerInterface $logger
    ) {
        $this->topicRepository = $topicRepository;
        $this->extensionFactory = $extensionFactory;
        $this->logger = $logger;
    }
    
    /**
     * Set attributes the blog entity after the GetById method is called.
     *
     * @param \Ecommistry\Blog\Api\BlogRepositoryInterface $blogRepository
     * @param \Ecommistry\Blog\Api\Data\BlogInterface      $blog
     *
     * @return \Ecommistry\Blog\Api\Data\BlogInterface
     */
    public function afterGetById(
        BlogRepositoryInterface $blogRepository,
        BlogInterface $blog
    ) {
        return $this->setTopicAttributes($blog);
    }
    
    /**
     * Set attributes for each blog entity after the getList method is called.
     *
     * @param \Ecommistry\Blog\Api\BlogRepositoryInterface        $blogRepository
     * @param \Ecommistry\Blog\Api\Data\BlogSearchResultInterface $blogSearchResult
     *
     * @return \Ecommistry\Blog\Api\Data\BlogSearchResultInterface
     */
    public function afterGetList(
        BlogRepositoryInterface $blogRepository,
        BlogSearchResultInterface $blogSearchResult
    ) {
        $blogCollection = $blogSearchResult->getItems();
        foreach ($blogCollection as &$blog) {
            $this->setTopicAttributes($blog);
        }
        unset($blog);
        $blogSearchResult->setItems($blogCollection);
        return $blogSearchResult;
    }
    
    /**
     * Set the topic extension attributes.
     *
     * @param \Ecommistry\Blog\Api\Data\BlogInterface $blog
     *
     * @return \Ecommistry\Blog\Api\Data\BlogInterface
     */
    private function setTopicAttributes(BlogInterface $blog)
    {
        try {
            $topicData = $this->topicRepository->getById($blog->getTopicId());
            if ($topicData) {
                $extensionAttributes = $blog->getExtensionAttributes();
                $extensionAttributes = $extensionAttributes
                    ?: $this->extensionFactory->create();
                $extensionAttributes->setTopicName($topicData->getTitle());
                $extensionAttributes->setTopicDescription($topicData->getDescription());
                $blog->setExtensionAttributes($extensionAttributes);
            }
        } catch (NoSuchEntityException $exception) {
            $this->logger->debug($exception->getMessage());
        }
        
        return $blog;
    }
}
