<?php

namespace Ecommistry\Blog\Ui\Component\Listing\Columns;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Ecommistry\Blog\Model\ResourceModel\Topic\CollectionFactory as TopicCollectionFactory;

/**
 * Class Topic Component
 *
 * Prepare the Topic information for the blog.
 *
 * @category   Ecommistry
 * @package    Ecommistry_Blog
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class Topic extends Column
{
    private $topicFactory;
    
    /**
     * Topic constructor.
     *
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Framework\View\Element\UiComponentFactory           $uiComponentFactory
     * @param \Ecommistry\Blog\Model\ResourceModel\Topic\CollectionFactory $topicFactory
     * @param array                                                        $components
     * @param array                                                        $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        TopicCollectionFactory $topicFactory,
        array $components = [],
        array $data = []
    ) {
        $this->topicFactory = $topicFactory->create();
        parent::__construct(
            $context,
            $uiComponentFactory,
            $components,
            $data
        );
    }
    
    /**
     * Convert the Topic IDs to their corresponding name.
     *
     * @param array $dataSource
     *
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item[$this->getData('name')])) {
                    $id = $item[$this->getData('name')];
                    /** @var \Ecommistry\Blog\Api\Data\TopicInterface $topic */
                    $topic = $this->topicFactory->getItemById($id);
                    $item[$this->getData('name')] = $topic->getTitle();
                }
            }
        }
        
        return $dataSource;
    }
}
