<?php

class AdminController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function lockAction()
    {
        $status = $this->getRequest()->getParam('status');
        $config = new Zend_Config_Ini(APPLICATION_PATH.'/configs/application.ini',
                              null,
                              array('skipExtends'        => true,
                                    'allowModifications' => true));
        $config->production->SYSTEM_STATUS = $status;
        $writer = new Zend_Config_Writer_Ini(array('config'   => $config,
                                           'filename' => APPLICATION_PATH.'/configs/application.ini'));
        $writer->write();
        echo Zend_Json::encode($config->production->SYSTEM_STATUS);

        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function statusAction()
    {
        $status = $this->getRequest()->getParam('status');
        $config = new Zend_Config_Ini(APPLICATION_PATH.'/configs/application.ini',
                              null,
                              array('skipExtends'        => true,
                                    'allowModifications' => true));
        echo Zend_Json::encode($config->production->SYSTEM_STATUS);
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }


}





