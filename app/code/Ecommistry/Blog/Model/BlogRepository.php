<?php

namespace Ecommistry\Blog\Model;

use Ecommistry\Blog\Api\BlogRepositoryInterface;
use Ecommistry\Blog\Api\Data\BlogInterface;
use Ecommistry\Blog\Api\Data\BlogInterfaceFactory;
use Ecommistry\Blog\Api\Data\BlogSearchResultInterfaceFactory;
use Ecommistry\Blog\Model\ResourceModel\Blog\Collection;
use Ecommistry\Blog\Model\ResourceModel\Blog\CollectionFactory;
use Ecommistry\Blog\Model\ResourceModel\BlogFactory as BlogResourceFactory;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class BlogRepository
 *
 * Implementation of blog repository for CRUD operations.
 *
 * @category   Ecommistry
 * @package    Ecommistry_Blog
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class BlogRepository implements BlogRepositoryInterface
{
    /** @var \Ecommistry\Blog\Model\BlogInterfaceFactory */
    private $blogFactory;
    /** @var \Ecommistry\Blog\Model\ResourceModel\BlogFactory */
    private $blogReourceFactory;
    /** @var \use Ecommistry\Blog\Model\ResourceModel\Blog\CollectionFactory */
    private $collectionFactory;
    /** @var \Ecommistry\Blog\Api\Data\BlogSearchResultInterface */
    private $searchResultFactory;
    
    public function __construct(
        BlogInterfaceFactory $blogFactory,
        BlogResourceFactory $blogResourceFactory,
        CollectionFactory $collectionFactory,
        BlogSearchResultInterfaceFactory $searchResultFactory
    ) {
        $this->blogFactory = $blogFactory;
        $this->blogReourceFactory = $blogResourceFactory;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultFactory = $searchResultFactory;
    }
    
    /**
     * @param \Ecommistry\Blog\Api\Data\BlogInterface $blog
     *
     * @return \Ecommistry\Blog\Api\Data\BlogInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(BlogInterface $blog)
    {
        $blogResource = $this->blogReourceFactory->create();
        try {
            $blogResource->save($blog);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
    
        return $blog;
    }
    
    /**
     * @param int $id
     *
     * @return \Ecommistry\Blog\Api\Data\BlogInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById(int $id)
    {
        $blog = $this->blogFactory->create();
        $blogResource = $this->blogReourceFactory->create();
        
        $blogResource->load($blog, $id);
        if (!$blog->getId()) {
            throw new NoSuchEntityException(__(
                "Unable to find blog with ID '$id'"
            ));
        }
        return $blog;
    }
    
    /**
     * @param \Ecommistry\Blog\Api\Data\BlogInterface $blog
     *
     * @return bool|void
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(BlogInterface $blog)
    {
        $blogResource = $this->blogReourceFactory->create();
        try {
            $blogResource->delete($blog);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }
    
    /**
     * @param int $id
     *
     * @return bool|void
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function deleteById(int $id)
    {
        return $this->delete($this->getById($id));
    }
    
    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     *
     * @return \Ecommistry\Blog\Api\BlogSearchResultInterface
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
     * @param \Magento\Framework\Api\SearchCriteriaInterface       $searchCriteria
     * @param \Ecommistry\Blog\Model\ResourceModel\Blog\Collection $collection
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
     * @param \Magento\Framework\Api\SearchCriteriaInterface       $searchCriteria
     * @param \Ecommistry\Blog\Model\ResourceModel\Blog\Collection $collection
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
     * @param \Magento\Framework\Api\SearchCriteriaInterface       $searchCriteria
     * @param \Ecommistry\Blog\Model\ResourceModel\Blog\Collection $collection
     */
    private function addPagingToCollection(
        SearchCriteriaInterface $searchCriteria,
        Collection $collection
    ) {
        $collection->setPageSize($searchCriteria->getPageSize());
        $collection->setCurPage($searchCriteria->getCurrentPage());
    }
    
    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface       $searchCriteria
     * @param \Ecommistry\Blog\Model\ResourceModel\Blog\Collection $collection
     *
     * @return \Ecommistry\Blog\Api\Data\BlogSearchResultInterface
     */
    private function buildSearchResult(
        SearchCriteriaInterface $searchCriteria,
        Collection $collection
    ) {
        /** @var \Ecommistry\Blog\Api\Data\BlogSearchResultInterface $searchResults */
        $searchResults = $this->searchResultFactory->create();
        
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        
        return $searchResults;
    }
}
