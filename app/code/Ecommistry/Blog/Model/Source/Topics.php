<?php

namespace Ecommistry\Blog\Model\Source;

use Ecommistry\Blog\Api\TopicRepositoryInterface;
use Ecommistry\Blog\Model\ResourceModel\Topic\CollectionFactory;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Option\ArrayInterface;

/**
 * Class Topics Model
 *
 * Available Topics to use in options array of a Ui Component.
 *
 * @category   Ecommistry
 * @package    Ecommistry_Blog
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class Topics implements ArrayInterface
{
    /** @var \Ecommistry\Blog\Api\TopicRepositoryInterface */
    private $topicRepository;
    /** @var \Magento\Framework\Api\SearchCriteriaBuilder */
    private $searchCriteriaBuilder;
    
    public function __construct(
        TopicRepositoryInterface $topicRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->topicRepository = $topicRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }
    
    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray()
    {
        $topics = [];
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $topicCollection = $this->topicRepository
            ->getList($searchCriteria)
            ->getItems();
        
        foreach ($topicCollection as $topic) {
            $topics[] = [
                'value' => $topic->getId(),
                'label' => $topic->getTitle()
            ];
        }
        return $topics;
    }
}
