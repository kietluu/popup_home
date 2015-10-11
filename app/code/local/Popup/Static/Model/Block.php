<?php

/**
 * Created by PhpStorm.
 * User: kietluu
 * Date: 09/10/2015
 * Time: 09:21
 */
class Popup_Static_Model_Block extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('popup_static/block');
    }

    //    check het trong nay roi gan vao array error


    public function checkConditionDateTime($array)
    {
//        TH OK1: (from < to < fromdate)
//        TH OK2: (todate <from < to)

//        check from <to

        if (empty($array['from_date']) || empty($array['to_date'])) {
            return Mage::helper('popup_static')->__('From Date or To Date is not set.');
        }

        if ($this->_checkDateTime($array) !== true) {
            return $this->_checkDateTime($array);
        }

//        select result from db (count) exist from >= fromdate and from <= todate
//        if exist => return false


        $model = Mage::getModel('popup_static/block')->getCollection();
        $result = $model->addFieldToSelect('from_date')
            ->addFieldToFilter('from_date', array('lteq' => $array['from_date']))
            ->addFieldToFilter('to_date', array('gteq' => $array['from_date']))
            ->count();

        if ($result > 0) {
            return Mage::helper('popup_static')->__('In this time period had other active popup. Please choose another time.');
        }

//        select result from db (count) exist to >= fromdate and to <= todate
//        if exist => return false
        $result = $model->addFieldToSelect('from_date')
            ->addFieldToFilter('from_date', array('lteq' => $array['to_date']))
            ->addFieldToFilter('to_date', array('gteq' => $array['to_date']))
            ->count();

        if ($result > 0) {
            return Mage::helper('popup_static')->__('In this time period had other active popup. Please choose another time.');
        }

//        select result from db (count) exist from < fromdate and to > todate
//        if exist => return false

        $result = $model->addFieldToSelect('from_date')
            ->addFieldToFilter('from_date', array('gt' => $array['from_date']))
            ->addFieldToFilter('to_date', array('lt' => $array['to_date']))
            ->count();

        if ($result > 0) {
            return $error[] = Mage::helper('popup_static')->__('In this time period had other active popup. Please choose another time.');
        }

        return true;

    }

    public function _checkDateTime($array)
    {
        if (empty($array)) {
            return $array;
        }
        return strtotime($array['to_date']) >= strtotime($array['from_date']) ?
            true : Mage::helper('popup_static')->__('End Date must be greater than Start Date.');
    }

}