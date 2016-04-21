<?php

class ReplyController extends Zend_Controller_Action
{
    public function init()
    {
        $this->reply = new Application_Model_DbTable_Reply();
    }

    public function indexAction()
    {
        // action body
    }

    public function addAction()
    {
        $reqParams = $this->getRequest()->getParams();
        if ($this->getRequest()->isPost()) {
            $rply = $this->reply->addReply($reqParams);
            echo Zend_Json::encode($rply);
        }
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function editAction()
    {
        $reqParams = $this->getRequest()->getParams();
        if ($this->getRequest()->isPost()) {
            $this->reply->editReply($reqParams);
        }
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function deleteAction()
    {
        $rplyId = $this->getRequest()->getParam('id');
        if ($rplyId) {
            $this->reply->deleteReply($rplyId);
        }
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function listAction()
    {
        // action body
    }
}
