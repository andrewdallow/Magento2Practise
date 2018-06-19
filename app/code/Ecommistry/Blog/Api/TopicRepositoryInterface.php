<?php

namespace Ecommistry\Blog\Api;

use Ecommistry\Blog\Api\Data\TopicInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Class TopicRepositoryInterface
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
interface TopicRepositoryInterface
{
    /**
     * @param \Ecommistry\Blog\Api\Data\TopicInterface $topic
     *
     * @return \Ecommistry\Blog\Api\Data\TopicInterface
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function save(TopicInterface $topic);
    
    /**
     * @param int $id
     *
     * @return \Ecommistry\Blog\Api\Data\TopicInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById(int $id);
    
    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     *
     * @return \Ecommistry\Blog\Api\Data\TopicSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
    
    /**
     * @param \Ecommistry\Blog\Api\Data\TopicInterface $topic
     *
     * @return bool
     * @throws \Exception
     */
    public function delete(TopicInterface $topic);
    
    /**
     * @param int $id
     *
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function deleteById(int $id);
}
