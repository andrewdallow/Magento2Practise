<?php

namespace Ecommistry\Repository\Setup;

use Ecommistry\Repository\Api\Data\CustomerInterfaceFactory;
use Ecommistry\Repository\Model\ResourceModel\CustomerFactory as CustomerResourceFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

/**
 * Class InstallData
 *
 * Install Demo Customer Data into Ecommistry Customer table.
 *
 * @category   Ecommistry
 * @package    Ecommistry_Repository
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class UpgradeData implements UpgradeDataInterface
{
    private $customerFactory;
    private $customerResourceFactory;
    
    public function __construct(
        CustomerInterfaceFactory $customerFactory,
        CustomerResourceFactory $customerResourceFactory
    ) {
        $this->customerFactory = $customerFactory;
        $this->customerResourceFactory = $customerResourceFactory;
    }
    
    /**
     * Upgrades data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface   $context
     *
     * @return void
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function upgrade(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();
        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            /** @var \Ecommistry\Repository\Model\ResourceModel\Customer $resource */
            $resource = $this->customerResourceFactory->create();
            
            $customers = [
                [
                    'first_name' => 'Mendy',
                    'last_name'  => 'Jeaves',
                    'address'    => '52418 Gale Park',
                    'country'    => 'New Zealand',
                ],
                [
                    'first_name' => 'Rubie',
                    'last_name'  => 'Pierrepont',
                    'address'    => '0455 Judy Pass',
                    'country'    => 'Russia',
                ],
                [
                    'first_name' => 'Leicester',
                    'last_name'  => 'Hollyland',
                    'address'    => '557 Muir Parkway',
                    'country'    => 'China',
                ],
                [
                    'first_name' => 'Ewell',
                    'last_name'  => 'Mirams',
                    'address'    => '0 Carpenter Circle',
                    'country'    => 'France',
                ],
                [
                    'first_name' => 'Ody',
                    'last_name'  => 'Collomosse',
                    'address'    => '33274 Paget Point',
                    'country'    => 'Japan',
                ],
                [
                    'first_name' => 'Garvy',
                    'last_name'  => 'Bramham',
                    'address'    => '64 Banding Street',
                    'country'    => 'Peru',
                ],
                [
                    'first_name' => 'Maggee',
                    'last_name'  => 'O Kelleher',
                    'address'    => '32713 Old Gate Drive',
                    'country'    => 'China',
                ],
                [
                    'first_name' => 'Marianna',
                    'last_name'  => 'Sleet',
                    'address'    => '29 Anzinger Crossing',
                    'country'    => 'New Zealand',
                ],
                [
                    'first_name' => 'Linnell',
                    'last_name'  => 'Meadows',
                    'address'    => '6078 Butternut Trail',
                    'country'    => 'Indonesia',
                ],
                [
                    'first_name' => 'Rhys',
                    'last_name'  => 'Ungerecht',
                    'address'    => '3 Sachtjen Junction',
                    'country'    => 'Russia',
                ],
                [
                    'first_name' => 'Zsazsa',
                    'last_name'  => 'Mugleston',
                    'address'    => '7 Marquette Circle',
                    'country'    => 'China',
                ],
                [
                    'first_name' => 'Mable',
                    'last_name'  => 'Walton',
                    'address'    => '7 Dapin Parkway',
                    'country'    => 'New Zealand',
                ]
            ];
            
            foreach ($customers as $customer) {
                $model = $this->customerFactory->create();
                $model->setData($customer);
                $resource->save($model);
            }
            unset($model);
        }
        $setup->endSetup();
    }
}
