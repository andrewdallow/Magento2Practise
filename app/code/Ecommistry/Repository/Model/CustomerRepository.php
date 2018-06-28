<?php

namespace Ecommistry\Repository\Model;

use Ecommistry\Repository\Api\CustomerRepositoryInterface;
use Ecommistry\Repository\Api\Data\CustomerSearchResultsInterface;
use Ecommistry\Repository\Api\Data\CustomerSearchResultsInterfaceFactory;
use Ecommistry\Repository\Model\ResourceModel\Customer\CollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class CustomerRepository
 *
 * Implementation Customer Repository.
 *
 * @category   Ecommistry
 * @package    Ecommistry_Repository
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class CustomerRepository implements CustomerRepositoryInterface
{
    /**
     * @var \Ecommistry\Repository\Model\ResourceModel\Customer\Collection
     */
    private $collection;
    /**
     * @var \Ecommistry\Repository\Api\Data\CustomerSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;
    
    public function __construct(
        CollectionFactory $collection,
        CustomerSearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->collection = $collection;
        $this->searchResultsFactory = $searchResultsFactory;
    }
    
    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     *
     * @return \Ecommistry\Repository\Api\Data\CustomerSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection $collection */
        $collection = $this->collection->create();
        
        $this->addFiltersToCollection($searchCriteria, $collection);
        $this->addSortOrdersToCollection($searchCriteria, $collection);
        $this->addPagingToCollection($searchCriteria, $collection);
        
        $collection->load();
        
        return $this->buildSearchResult($searchCriteria, $collection);
    }
    
    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface                          $searchCriteria
     * @param \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection $collection
     */
    private function addFiltersToCollection(
        SearchCriteriaInterface $searchCriteria,
        AbstractCollection $collection
    ): void {
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            $fields = [];
            $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $fields[] = $filter->getField();
                $conditions[]
                    = [$filter->getConditionType() => $filter->getValue()];
            }
            $collection->addFieldToFilter($fields, $conditions);
        }
    }
    
    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface                          $searchCriteria
     * @param \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection $collection
     */
    private function addSortOrdersToCollection(
        SearchCriteriaInterface $searchCriteria,
        AbstractCollection $collection
    ): void {
        foreach ($searchCriteria->getSortOrders() as $sortOrder) {
            $direction = strtolower($sortOrder->getDirection());
            $collection->addOrder($sortOrder->getField(), $direction);
        }
    }
    
    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface                          $searchCriteria
     * @param \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection $collection
     */
    private function addPagingToCollection(
        SearchCriteriaInterface $searchCriteria,
        AbstractCollection $collection
    ): void {
        $collection->setPageSize($searchCriteria->getPageSize());
        $collection->setCurPage($searchCriteria->getCurrentPage());
    }
    
    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface                          $searchCriteria
     * @param \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection $collection
     *
     * @return \Ecommistry\Repository\Api\Data\CustomerSearchResultsInterface
     */
    private function buildSearchResult(
        SearchCriteriaInterface $searchCriteria,
        AbstractCollection $collection
    ): CustomerSearchResultsInterface {
        /** @var \Ecommistry\Repository\Api\Data\CustomerSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        
        return $searchResults;
    }
}
