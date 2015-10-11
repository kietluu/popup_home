<?php

/**
 * Created by PhpStorm.
 * User: kietluu
 * Date: 09/10/2015
 * Time: 10:34
 */
class Popup_Static_Block_Adminhtml_Block_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

	public function __construct()
	{
		parent::__construct();

		$this->setId('popup_static_block_form');
		$this->setTitle($this->__('Popup Information'));
	}

//	protected function _prepareLayout()
//	{
//		parent::_prepareLayout();
//		if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
//			$this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
//		}
//	}

	protected function _prepareForm()
	{
		$model = Mage::registry('popup_static');

		$form = new Varien_Data_Form(array(
			'id' => 'edit_form',
			'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
			'method' => 'post'
		));

		$fieldset = $form->addFieldset('base_fieldset', array(
			'legend' => Mage::helper('checkout')->__('Popup Information'),
			'class' => 'fieldset-wide'
		));

		if ($model->getId()) {
			$fieldset->addField('id', 'hidden', array(
				'name' => 'id',
			));
		}else{
			$fieldset->addField('create_date', 'hidden', array(
				'name' => 'create_date',
			));
		}


		$collection_cms_block = Mage::getModel('cms/block')->getCollection();
		$static_blocks = $collection_cms_block->addFieldToSelect(array('title', 'block_id'))->getData();

		$arr_block_id = array();
		foreach ($static_blocks as $static_block) {
			$arr_block_id[$static_block['block_id']] = $static_block['title'];
		}

		$fieldset->addField('title', 'text', array(
			'name' => 'title',
			'label' => Mage::helper('checkout')->__('Title'),
			'title' => Mage::helper('checkout')->__('Title'),
			'required' => true,
		));

		$fieldset->addField('block_id', 'select', array(
			'label' => Mage::helper('checkout')->__('Static Block ID'),
			'title' => Mage::helper('checkout')->__('Static Block ID'),
			'class' => 'required-entry',
			'required' => true,
			'name' => 'block_id',
			'onclick' => "",
			'onchange' => "",
			'values' => $arr_block_id,
			'disabled' => false,
			'readonly' => false,
			'after_element_html' => '<small>Static Block</small>',
			'tabindex' => 1
		));

		$dateFormatIso = Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);
		$fieldset->addField('from_date', 'date', array(
			'name' => 'from_date',
			'label' => Mage::helper('checkout')->__('From Date'),
			'title' => Mage::helper('checkout')->__('Start Date'),
			'image' => $this->getSkinUrl('images/grid-cal.gif'),
//			'input_format' => $dateFormatIso,
			'input_format' => Varien_Date::DATETIME_INTERNAL_FORMAT,
//			'format' => $dateFormatIso,
			'format' =>  Varien_Date::DATETIME_INTERNAL_FORMAT,
			'time' => true,
			'required' => true,
			'style'   => "width:146px !important",
		));


		$fieldset->addField('to_date', 'date', array(
			'name' => 'to_date',
			'label' => Mage::helper('checkout')->__('To Date'),
			'title' => Mage::helper('checkout')->__('End Date'),
			'tabindex' => 1,
			'image' => $this->getSkinUrl('images/grid-cal.gif'),
//			'input_format' => $dateFormatIso,
			'input_format' => Varien_Date::DATETIME_INTERNAL_FORMAT,
			'format' =>  Varien_Date::DATETIME_INTERNAL_FORMAT,
			'time' => true,
			'required' => true,
			'style'   => "width:146px !important",
		));

		$fieldset->addField('expire_cookie', 'text', array(
			'name' => 'expire_cookie',
			'label' => Mage::helper('checkout')->__('Expire Cookie (Seconds)'),
			'title' => Mage::helper('checkout')->__('Expire Cookie (Seconds)'),
			'required' => true,
		));

		$fieldset->addField('time_hide', 'text', array(
			'name' => 'time_hide',
			'label' => Mage::helper('checkout')->__('Time hide popup (Seconds)'),
			'title' => Mage::helper('checkout')->__('Time hide popup (Seconds)'),
			'required' => true,
		));

		$form->setValues($model->getData());
		$form->setUseContainer(true);
		$this->setForm($form);

		return parent::_prepareForm();
	}
}