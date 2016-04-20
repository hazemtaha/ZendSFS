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
        $this->_helper->viewRenderer->setNoRender(TRUE);
    }

    public function editAction()
    {
        // action body
    }

    public function deleteAction()
    {
        $rplyId = $this->getRequest()->getParam('id');
        if ($rplyId) {
            $this->rply->deleteReply($rplyId);
        }
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(TRUE);
    }

    public function listAction()
    {
        // action body
    }


}
