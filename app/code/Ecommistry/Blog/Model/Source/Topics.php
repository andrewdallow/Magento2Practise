<?php

namespace Ecommistry\Blog\Model\Source;

use Ecommistry\Blog\Model\ResourceModel\Topic\CollectionFactory;
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
    private $topicCollection;
    
    public function __construct(
        CollectionFactory $collectionFactory
    ) {
        $this->topicCollection = $collectionFactory->create();
    }
    
    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray()
    {
        $topics = [];
        $topicCollection = $this->topicCollection->getItems();
        foreach ($topicCollection as $topic) {
            $topics[] = [
                'value' => $topic->getId(),
                'label' => $topic->getTitle()
            ];
        }
        return $topics;
    }
}
