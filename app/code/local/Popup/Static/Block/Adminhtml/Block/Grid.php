<?php

/**
 * Created by PhpStorm.
 * User: kietluu
 * Date: 09/10/2015
 * Time: 09:59
 */
class Popup_Static_Block_Adminhtml_Block_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	public function __construct()
	{
		parent::__construct();

		$this->setDefaultSort('id');
		$this->setId('popup_static_block_grid');
		$this->setDefaultDir('asc');
		$this->setSaveParametersInSession(true);
//		$this->setUseAjax(true);
	}

	protected function _getCollectionClass()
	{
		return 'popup_static/block_collection';
	}

	protected function _prepareCollection()
	{
		$collection = Mage::getResourceModel($this->_getCollectionClass())
			->join(array('a' => 'cms/block'), 'main_table.block_id = a.block_id', array('static_block_title' => 'a.title'));
		$this->setCollection($collection);
		return parent::_prepareCollection();

//		$collection = Mage::getResourceModel('sales/order_collection')
//			->join(array('a' => 'sales/order_address'), 'main_table.entity_id = a.parent_id AND a.address_type != \'billing\'', array(
//				'city' => 'city',
//				'country_id' => 'country_id'
//			))
//			->join(array('c' => 'customer/customer_group'), 'main_table.customer_group_id = c.customer_group_id', array(
//				'customer_group_code' => 'customer_group_code'
//			))
//			->addExpressionFieldToSelect(
//				'fullname',
//				'CONCAT({{customer_firstname}}, \' \', {{customer_lastname}})',
//				array('customer_firstname' => 'main_table.customer_firstname', 'customer_lastname' => 'main_table.customer_lastname'))
//			->addExpressionFieldToSelect(
//				'products',
//				'(SELECT GROUP_CONCAT(\' \', x.name)
//                    FROM sales_flat_order_item x
//                    WHERE {{entity_id}} = x.order_id
//                        AND x.product_type != \'configurable\')',
//				array('entity_id' => 'main_table.entity_id')
//			);
	}

	protected function _prepareColumns()
	{

		$this->addColumn('block_id',
			array(
				'header' => $this->__('Static Block ID'),
				'align' => 'right',
				'width' => '50px',
				'index' => 'block_id'
			)
		);

		$this->addColumn('title',
			array(
				'header' => $this->__('Title'),
				'align' => 'right',
				'width' => '50px',
				'index' => 'title'
			)
		);

		$this->addColumn('static_block_title',
			array(
				'header' => $this->__('Static Block'),
				'align' => 'right',
				'width' => '50px',
				'index' => 'static_block_title'
			)
		);




		$this->addColumn('create_date',
			array(
				'header' => $this->__('Create Date'),
				'align' => 'right',
				'width' => '50px',
				'index' => 'create_date'
			)
		);

		$this->addColumn('from_date',
			array(
				'header' => $this->__('From Date'),
				'align' => 'right',
				'width' => '50px',
				'index' => 'from_date'
			)
		);

		$this->addColumn('to_date',
			array(
				'header' => $this->__('To Date'),
				'align' => 'right',
				'width' => '50px',
				'index' => 'to_date'
			)
		);

		$this->addColumn('expire_cookie',
			array(
				'header' => $this->__('Expire_Cookie'),
				'align' => 'right',
				'width' => '50px',
				'index' => 'expire_cookie'
			)
		);

		$this->addColumn('time_hide',
			array(
				'header' => $this->__('Time hide popup'),
				'align' => 'right',
				'width' => '50px',
				'index' => 'time_hide'
			)
		);

		return parent::_prepareColumns();
	}

	public function getRowUrl($row)
	{
		return $this->getUrl('*/*/edit', array('id' => $row->getId()));
	}


}