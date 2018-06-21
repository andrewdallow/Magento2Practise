<?php

namespace Ecommistry\Blog\Model;

use Ecommistry\Blog\Api\Data\TopicInterface;
use Ecommistry\Blog\Api\Data\TopicInterfaceFactory;
use Ecommistry\Blog\Api\Data\TopicSearchResultInterfaceFactory;
use Ecommistry\Blog\Model\ResourceModel\TopicFactory as TopicResourceFactory;
use Ecommistry\Blog\Model\ResourceModel\Topic\CollectionFactory;
use Ecommistry\Blog\Model\ResourceModel\Topic\Collection;
use Ecommistry\Blog\Api\TopicRepositoryInterface;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class TopicRepository
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
class TopicRepository implements TopicRepositoryInterface
{
    /** @var \Ecommistry\Blog\Api\Data\TopicInterfaceFactory */
    private $topicFactory;
    /** @var \Ecommistry\Blog\Model\ResourceModel\TopicFactory */
    private $topicResourceFactory;
    /** @var \Ecommistry\Blog\Model\ResourceModel\Topic\CollectionFactory */
    private $collectionFactory;
    /** @var \Ecommistry\Blog\Api\Data\TopicSearchResultInterfaceFactory */
    private $searchResultFactory;
    
    /**
     * TopicRepository constructor.
     *
     * @param \Ecommistry\Blog\Api\Data\TopicInterfaceFactory              $topicFactory
     * @param \Ecommistry\Blog\Model\ResourceModel\TopicFactory            $topicResourceFactory
     * @param \Ecommistry\Blog\Model\ResourceModel\Topic\CollectionFactory $collectionFactory
     * @param \Ecommistry\Blog\Api\Data\TopicSearchResultInterfaceFactory  $searchResultFactory
     */
    public function __construct(
        TopicInterfaceFactory $topicFactory,
        TopicResourceFactory $topicResourceFactory,
        CollectionFactory $collectionFactory,
        TopicSearchResultInterfaceFactory $searchResultFactory
    ) {
        $this->topicFactory = $topicFactory;
        $this->topicResourceFactory = $topicResourceFactory;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultFactory = $searchResultFactory;
    }
    
    /**
     * @param \Ecommistry\Blog\Api\Data\TopicInterface $topic
     *
     * @return \Ecommistry\Blog\Api\Data\TopicInterface
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function save(TopicInterface $topic)
    {
        $topicResource = $this->topicResourceFactory->create();
        $topicResource->save($topic);
        
        return $topic;
    }
    
    /**
     * @param int $id
     *
     * @return \Ecommistry\Blog\Api\Data\TopicInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById(int $id)
    {
        $topic = $this->topicFactory->create();
        $topicResource = $this->topicResourceFactory->create();
        
        $topicResource->load($topic, $id);
        if (!$topic->getId()) {
            throw new NoSuchEntityException(__(
                "Unable to find topic with ID '$id'"
            ));
        }
        return $topic;
    }
    
    /**
     * @param \Ecommistry\Blog\Api\Data\TopicInterface $topic
     *
     * @return bool
     * @throws \Exception
     */
    public function delete(TopicInterface $topic)
    {
        $topicResource = $this->topicResourceFactory->create();
        $topicResource->delete($topic);
        
        return true;
    }
    
    /**
     * @param int $id
     *
     * @return bool
     * @throws \Exception
     */
    public function deleteById(int $id)
    {
        $topic = $this->topicFactory->create();
        $topicResource = $this->topicResourceFactory->create();
        
        $topicResource->load($topic, $id);
        if (!$topic->getId()) {
            throw new NoSuchEntityException(__(
                "Unable to find topic with ID '$id'"
            ));
        }
        $topicResource->delete($topic);
        
        return true;
    }
    
    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     *
     * @return \Ecommistry\Blog\Api\Data\TopicSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();
        
        $this->addFiltersToCollection($searchCriteria, $collection);
        $this->addSortOrdersToCollection($searchCriteria, $collection);
        $this->addPagingToCollection($searchCriteria, $collection);
        
        $collection->load();
        
        return $this->buildSearchResult($searchCriteria, $collection);
    }
    
    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface        $searchCriteria
     * @param \Ecommistry\Blog\Model\ResourceModel\Topic\Collection $collection
     */
    private function addFiltersToCollection(
        SearchCriteriaInterface $searchCriteria,
        Collection $collection
    ) {
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            $fields = $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $fields[] = $filter->getField();
                $conditions[]
                    = [$filter->getConditionType() => $filter->getValue()];
            }
            $collection->addFieldToFilter($fields, $conditions);
        }
    }
    
    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface        $searchCriteria
     * @param \Ecommistry\Blog\Model\ResourceModel\Topic\Collection $collection
     */
    private function addSortOrdersToCollection(
        SearchCriteriaInterface $searchCriteria,
        Collection $collection
    ) {
        foreach ((array)$searchCriteria->getSortOrders() as $sortOrder) {
            $direction = $sortOrder->getDirection() === SortOrder::SORT_ASC
                ? 'asc' : 'desc';
            $collection->addOrder($sortOrder->getField(), $direction);
        }
    }
    
    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface        $searchCriteria
     * @param \Ecommistry\Blog\Model\ResourceModel\Topic\Collection $collection
     */
    private function addPagingToCollection(
        SearchCriteriaInterface $searchCriteria,
        Collection $collection
    ) {
        $collection->setPageSize($searchCriteria->getPageSize());
        $collection->setCurPage($searchCriteria->getCurrentPage());
    }
    
    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface        $searchCriteria
     * @param \Ecommistry\Blog\Model\ResourceModel\Topic\Collection $collection
     *
     * @return \Ecommistry\Blog\Api\Data\TopicSearchResultInterface
     */
    private function buildSearchResult(
        SearchCriteriaInterface $searchCriteria,
        Collection $collection
    ) {
        /** @var \Ecommistry\Blog\Api\Data\TopicSearchResultInterface $searchResults */
        $searchResults = $this->searchResultFactory->create();
        
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        
        return $searchResults;
    }
}
