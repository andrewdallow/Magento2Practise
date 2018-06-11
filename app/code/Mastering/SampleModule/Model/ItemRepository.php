<?php

namespace Mastering\SampleModule\Model;

use Mastering\SampleModule\Api\ItemRepositoryInterface;
use Mastering\SampleModule\Model\ResourceModel\Item\CollectionFactory;

/**
 * Class ItemRepository
 *
 * Long description for Class (if any)...
 *
 * @category   Mastering
 * @package    Mastering_SampleModule
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class ItemRepository implements ItemRepositoryInterface
{
    private $collectionFactory;
    
    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }
    
    /**
     * @return \Mastering\SampleModule\Api\Data\ItemInterface[]
     */
    public function getList(): array
    {
        return $this->collectionFactory->create()->getItems();
    }
}
