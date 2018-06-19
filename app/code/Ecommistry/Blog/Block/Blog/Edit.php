<?php

namespace Ecommistry\Blog\Block\Blog;

use Ecommistry\Blog\Api\BlogRepositoryInterface;
use Ecommistry\Blog\Api\TopicRepositoryInterface;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Magento\Framework\Message\ManagerInterface;

/**
 * Edit Block
 *
 * Handles the display of the page for editing a single blog post.
 *
 * @category   Ecommistry
 * @package    Ecommistry_Blog
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class Edit extends Template implements IdentityInterface
{
    /** @var \Ecommistry\Blog\Api\BlogRepositoryInterface */
    private $blogRepository;
    /** @var \Ecommistry\Blog\Api\TopicRepositoryInterface */
    private $topicRepository;
    /** @var \Magento\Framework\Api\SearchCriteriaBuilder */
    private $searchCriteriaBuilder;
    /** @var \Magento\Framework\Message\ManagerInterface */
    private $messageManager;
    
    public function __construct(
        Template\Context $context,
        BlogRepositoryInterface $blogRepository,
        TopicRepositoryInterface $topicRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        ManagerInterface $messageManager
    ) {
        $this->topicRepository = $topicRepository;
        $this->blogRepository = $blogRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        parent::__construct($context);
        $this->messageManager = $messageManager;
    }
    
    /**
     * Get the post specified by the id param.
     *
     * @return \Ecommistry\Blog\Api\Data\BlogInterface
     */
    public function getBlogPost()
    {
        $blogId = $this->getRequest()->getParam('blog_id');
        if ($blogId) {
            try {
                return $this->blogRepository->getById($blogId);
            } catch (NoSuchEntityException $exception) {
                $this->messageManager->addErrorMessage($exception->getMessage());
            }
        }
    }
    
    /**
     * @return string
     */
    public function getFormAction()
    {
        if ($this->getRequest()->getParam('blog_id')) {
            return '/blog/index/edit?id=' . $this->getRequest()
                    ->getParam('blog_id');
        }
        return '/blog/index/edit';
    }
    
    /**
     * @return \Ecommistry\Blog\Api\Data\TopicInterface[]
     */
    public function getTopics()
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $searchResult = $this->topicRepository->getList($searchCriteria);
        return $searchResult->getItems();
    }
    
    /**
     * Return unique ID(s) for each object in system
     *
     * @return string[]
     */
    public function getIdentities()
    {
        $identities = [];
        $blogPost = $this->getBlogPost();
        if ($blogPost) {
            $identities = $this->getBlogPost()->getIdentities();
        }
        return $identities;
    }
}
