<?php

namespace Ecommistry\Blog\Block;

use Ecommistry\Blog\Api\BlogRepositoryInterface;
use Ecommistry\Blog\Api\TopicRepositoryInterface;

use Ecommistry\Blog\Model\TopicFactory;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;

/**
 * Blog Block
 *
 * Handles the display of all blog posts on one page.
 *
 * @category   Ecommistry
 * @package    Ecommistry_Blog
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class Blog extends Template implements IdentityInterface
{
    private const XML_PATH_NUMBER_OF_POSTS_TO_SHOW = 'blogs/settings/numberOfPostsToShow';
    
    private $topicFactory;
    /** @var \Ecommistry\Blog\Api\TopicRepositoryInterface */
    private $topicRepository;
    /** @var \Ecommistry\Blog\Api\BlogRepositoryInterface */
    private $blogRepository;
    /** @var \Magento\Framework\Api\SearchCriteriaBuilder */
    private $searchCriteriaBuilder;
    /** @var \Magento\Framework\App\Config\ScopeConfigInterface */
    private $config;
    
    public function __construct(
        Template\Context $context,
        BlogRepositoryInterface $blogRepository,
        TopicRepositoryInterface $topicRepository,
        TopicFactory $topicFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        ScopeConfigInterface $config
    ) {
        $this->blogRepository = $blogRepository;
        $this->topicRepository = $topicRepository;
        $this->topicFactory = $topicFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->config = $config;
        parent::__construct($context);
    }
    
    /**
     * @return \Ecommistry\Blog\Api\Data\BlogInterface[]
     */
    public function getPosts()
    {
        $numberOfPostsToShow = (int)$this->config->getValue(
            self::XML_PATH_NUMBER_OF_POSTS_TO_SHOW
        );
    
        $searchCriteria = $this->searchCriteriaBuilder;
        $searchCriteria->setPageSize($numberOfPostsToShow);
        $searchCriteria->create();
        $searchResult = $this->blogRepository->getList($searchCriteria);
    
        return $searchResult->getItems();
    }
    
    /**
     * @param $id
     *
     * @return \Ecommistry\Blog\Api\Data\TopicInterface
     */
    public function getTopicById($id)
    {
        try {
            return $this->topicRepository->getById($id);
        } catch (NoSuchEntityException $exception) {
            return $this->topicFactory->create()->setTitle('Unknown');
        }
    }
    
    /**
     * Return unique ID(s) for each object in system
     *
     * @return string[]
     */
    public function getIdentities()
    {
        $identities = [];
        $posts = $this->getPosts();
        foreach ($posts as $post) {
            $identities[] = $post->getIdentities()[0];
        }
        return $identities;
    }
}