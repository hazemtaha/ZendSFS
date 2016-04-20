<?php

class ForumController extends Zend_Controller_Action
{

    private $forum = null;

    private $category = null,$thread;

    public function init()
    {
      $this->category = new Application_Model_DbTable_Category();
      $this->forum = new Application_Model_DbTable_Forum();
      $this->thread = new Application_Model_DbTable_Thread();
    }

    public function indexAction()
    {
        // action body
    }

    public function listAction()
    {
        $this->view->categories = $this->category->getCategories();
        $this->view->forums = $this->forum->getForums();
    }

    public function postsAction()
    {
        $fId = $this->getRequest()->getParam('id');
        $threads = $this->thread->getThreadsByForum($fId);
        if (isset($threads)) {
        $paginator = Zend_Paginator::factory($threads);
        $paginator->setItemCountPerPage(5);
        $paginator->setCurrentPageNumber($this->getRequest()->getParam('page'));
        $this->view->paginator = $paginator;
        $this->view->forumId = $fId;
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('thread/_pagination.phtml');
      }
        // $this->view->threads = $this->thread->getThreadsByForum($fId);
    }


}
