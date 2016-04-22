<?php

class ThreadController extends Zend_Controller_Action
{
    private $thread,$reply;
    public function init()
    {
        $this->thread = new Application_Model_DbTable_Thread();
        $this->reply = new Application_Model_DbTable_Reply();
    }

    public function indexAction()
    {
        $this->redirect('/forum/list');
    }

    public function addAction()
    {
        $reqParams = $this->getRequest()->getParams();
        $form = new Application_Form_Thread();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($reqParams)) {
                if ($this->thread->addThread($reqParams)) {
                    $this->redirect('forum/posts/id/'.$reqParams['forum']);
                }
            }
        }
        $this->view->form = $form;
    }

    public function deleteAction()
    {
        if ($this->getRequest()->isPost()) {
            $threadId = $this->getRequest()->getParam('id');
            if ($threadId) {
                $this->thread->deleteThread($threadId);
            }
        }
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function editAction()
    {
        $reqParams = $this->getRequest()->getParams();
        if ($this->getRequest()->isPost()) {
            $this->thread->editThread($reqParams);
        }
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function listAction()
    {
        $threads = $this->thread->listThreads();
        if (isset($threads)) {
            $paginator = Zend_Paginator::factory($threads);
            $paginator->setItemCountPerPage(3);
            $paginator->setCurrentPageNumber($this->getRequest()->getParam('page'));
            $this->view->paginator = $paginator;
            Zend_Paginator::setDefaultScrollingStyle('Sliding');
            Zend_View_Helper_PaginationControl::setDefaultViewPartial('thread/_pagination.phtml');
        }
    }

    public function lockAction()
    {
        $reqParams = $this->getRequest()->getParams();
        if ($this->getRequest()->isPost()) {
            $this->thread->toggleThreadLock($reqParams);
        }
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
  
    }

    public function pinAction()
    {
        $reqParams = $this->getRequest()->getParams();
        if ($this->getRequest()->isPost()) {
            $this->thread->toggleThreadPin($reqParams);
        }
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function detailAction()
    {
        $threadId = $this->getRequest()->getParam('id');
        if ($threadId) {
            if ($thread = $this->thread->getThreadById($threadId)) {
                $this->view->thread = $thread;
                $this->view->replies = $this->reply->getRepliesByThread($threadId);
            } else {
                $this->redirect('thread/list');
            }
        }
    }
}
