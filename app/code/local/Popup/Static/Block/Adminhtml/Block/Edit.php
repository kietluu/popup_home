<?php
/**
 * Created by PhpStorm.
 * User: kietluu
 * Date: 09/10/2015
 * Time: 10:00
 */
class Popup_Static_Block_Adminhtml_Block_Edit extends Mage_Adminhtml_Block_Widget_Form_Container{
	public function __construct()
	{
		$this->_blockGroup = 'popup_static';
		$this->_controller = 'adminhtml_block';

		parent::__construct();

		$this->_updateButton('save', 'label', $this->__('Save Popup'));
		$this->_updateButton('delete', 'label', $this->__('Delete Popup'));
	}

	public function getHeaderText()
	{
		if(Mage::registry('popup_static')->getId()){
			return $this->__('Edit Popup');
		}else{
			return $this->__('New Popup');
		}
	}
}