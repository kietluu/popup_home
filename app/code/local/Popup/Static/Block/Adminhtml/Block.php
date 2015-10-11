<?php
/**
 * Created by PhpStorm.
 * User: kietluu
 * Date: 09/10/2015
 * Time: 09:45
 */
class Popup_Static_Block_Adminhtml_Block extends Mage_Adminhtml_Block_Widget_Grid_Container{
	public function __construct()
	{
		$this->_blockGroup = 'popup_static';
		$this->_controller = 'adminhtml_block';
		$this->_headerText = $this->__('Block');

		parent::__construct();}
}