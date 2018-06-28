<?php

namespace Ecommistry\Repository\Block;

use Ecommistry\Repository\Api\CustomerRepositoryInterfaceFactory;
use Ecommistry\Repository\Api\Data\CustomerInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Element\Template;

/**
 * Class ListCustomers
 *
 * Long description for Class (if any)...
 *
 * @category   Ecommistry
 * @package    Ecommistry_Repository
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class ListCustomers extends Template
{
    /**
     * @var \Ecommistry\Repository\Api\CustomerRepositoryInterfaceFactory
     */
    private $customerRepository;
    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    private $criteriaBuilder;
    /**
     * @var \Magento\Framework\Api\SortOrderBuilder
     */
    private $sortOrderBuilder;
    
    public function __construct(
        Context $context,
        CustomerRepositoryInterfaceFactory $customerRepositoryFactory,
        SearchCriteriaBuilder $criteriaBuilder,
        SortOrderBuilder $sortOrderBuilder,
        array $data = []
    ) {
        $this->customerRepository = $customerRepositoryFactory;
        $this->criteriaBuilder = $criteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
        parent::__construct($context, $data);
    }
    
    /**
     * @param string $name
     *
     * @return \Ecommistry\Repository\Api\Data\CustomerInterface[]
     */
    public function getCustomersByCountryName(string $name)
    {
        /** @var \Ecommistry\Repository\Api\CustomerRepositoryInterface $customerRepository */
        $customerRepository = $this->customerRepository->create();
        
        $sortOrder = $this->sortOrderBuilder
            ->setField(CustomerInterface::LAST_NAME)
            ->setDirection(SortOrder::SORT_ASC)
            ->create();
        $searchCriteria = $this->criteriaBuilder
            ->addFilter(
                CustomerInterface::COUNTRY,
                "%$name%",
                'like'
            )->setSortOrders([$sortOrder])
            ->create();
        return $customerRepository->getList($searchCriteria)->getItems();
    }
}
