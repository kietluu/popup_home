<?php

/**
 * Created by PhpStorm.
 * User: kietluu
 * Date: 09/10/2015
 * Time: 09:35
 */
class Popup_Static_Adminhtml_BlockController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        // instantiate the grid container
        $brandBlock = $this->getLayout()->createBlock('popup_static_adminhtml/block');

        // Add the grid container as the only item on this page
        $this->loadLayout()
            ->_addContent($brandBlock)
            ->renderLayout();
    }

    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('cms/popup_static_block')
            ->_title($this->__('CMS'))->_title($this->__('Popup Management'))
            ->_addBreadcrumb($this->__('CMS'), $this->__('CMS'))
            ->_addBreadcrumb($this->__('Popup Management'), $this->__('Popup Management'));
        return $this;
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('cms/popup_static_block');
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {

        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('popup_static/block');

        if ($id) {
            $model->load($id);

            if (!$model->getId()) {
                Mage::getSingleton('admin/session')->addError($this->__('This block no longer exists.'));
                $this->_redirect('*/*/');

                return;
            }
        }

        $this->_title($model->getId() ? $model->getName() : $this->__('New Popup'));

        $data = Mage::getSingleton('adminhtml/session')->getBlockData(true);
        if (!empty($data)) {
            $model->setData($data);
        } elseif (!$model->getId()) {
            $model->setData(array(
                'expire_cookie' => '86400',
                'time_hide' => '5',
                'create_date' => Mage::getModel('core/date')->date(),
            ));
        }

        Mage::register('popup_static', $model);

        $this->_initAction()
            ->_addBreadcrumb($id ? $this->__('Edit Popup') : $this->__('New Popup'), $id ? $this->__('Edit Popup') : $this->__('New Popup'))
            ->_addContent($this->getLayout()->createBlock('popup_static/adminhtml_block_edit')->setData('action', $this->getUrl('*/*/save')))
            ->renderLayout();

    }

    public function saveAction()
    {


        if ($postData = $this->getRequest()->getPost()) {
            $model = Mage::getSingleton('popup_static/block');

            /**
             * validate from date vs to date
             */
            $model_check = Mage::getModel('popup_static/block');

            $a = $model_check->_checkDateTime($postData);
            $errorMessage = $model_check->checkConditionDateTime($postData);

            if ($errorMessage !== true) {
                $this->_getSession()->addError($errorMessage);
                $this->_getSession()->setBlockData($postData);
                $this->_redirect('*/*/edit');
                return;
            }
//            echo '<pre>';
//            var_dump($errorMessage);
//            die;
            $model->setData($postData);

            try {
                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The popup has been saved.'));

                return $this->_redirect('*/*/');
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessages());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('An error occurred'));
            }

            Mage::getSingleton('adminhtml/session')->setBlockData($postData);
            $this->_redirectReferer();
        }
    }

    public function deleteAction()
    {
        try {
            $id = $this->getRequest()->getParam('id');
            if ($id) {
                if ($registry = Mage::getModel('popup_static/block')->load($id)) {
                    $registry->delete();
                    $successMessage = Mage::helper('popup_static')->__('Popup has been succesfully deleted.');
                    Mage::getSingleton('core/session')->addSuccess($successMessage);
                    $this->_redirect('*/*/');

                } else {
                    throw new Exception("There was a problem deleting the popup");
                }
            }
        } catch (Exception $e) {
            Mage::getSingleton('core/session')->addError($e->getMessage());
            $this->_redirect('*/*/');
        }
    }

    public function messageAction()
    {
        $data = Mage:: getModel('popup_static/block')->load($this->getRequest()->getParam('id'));
        echo $data->getContent();
    }
}