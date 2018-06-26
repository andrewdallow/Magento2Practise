<?php

namespace Ecommistry\Blog\Setup;

use Ecommistry\Blog\Model\ResourceModel\TopicFactory as ResourceFactory;
use Ecommistry\Blog\Model\TopicFactory;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

/**
 * Class UpgradeData
 *
 * Long description for Class (if any)...
 *
 * @category   Training
 * @package    Training_ExtAttribute
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var \Ecommistry\Blog\Model\ResourceModel\TopicFactory
     */
    private $resourceFactory;
    /**
     * @var \Ecommistry\Blog\Model\TopicFactory
     */
    private $topicFactory;
    
    public function __construct(
        ResourceFactory $resourceFactory,
        TopicFactory $topicFactory
    ) {
        $this->resourceFactory = $resourceFactory;
        $this->topicFactory = $topicFactory;
    }
    
    /**
     * @param \Magento\Framework\Setup\ModuleDataSetupInterface $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface   $context
     *
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function upgrade(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();
        if (version_compare($context->getVersion(), '1.0.2', '<')) {
            $topics = [
                [
                    'title'       => 'Unnamed',
                    'description' => 'No Topic'
                ],
                [
                    'title'       => 'Magento Themes',
                    'description' => 'All about Magento 2 themes'
                ],
                [
                    'title'       => 'Magento Modules',
                    'description' => 'All about Magento Modules'
                ]
            ];
            /** @var \Ecommistry\Blog\Model\ResourceModel\Topic $topicResource */
            $topicResource = $this->resourceFactory->create();
            foreach ($topics as $topic) {
                /** @var \Ecommistry\Blog\Model\Topic $model */
                $model = $this->topicFactory->create();
                $model->setData($topic);
                $topicResource->save($model);
            }
            unset($model);
        }
        $setup->endSetup();
        
    }
}
