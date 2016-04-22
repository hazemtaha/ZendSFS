<?php

class ForumController extends Zend_Controller_Action
{
    private $forum = null;

    private $category = null;

    private $thread = null;

    public function init()
    {
        $this->category = new Application_Model_DbTable_Category();
        $this->forum = new Application_Model_DbTable_Forum();
        $this->thread = new Application_Model_DbTable_Thread();
        Zend_Loader::loadFile('Auth.php', APPLICATION_PATH.'/../library/utils/', true);
        $authSystem = new Auth();
        if ($this->getRequest()->getActionName() != 'list') {
            if ($this->getRequest()->getActionName() != 'posts') {
                if (!$authSystem->isAdmin()) {
                    $this->renderScript('404.phtml');
                }
            }
        }
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

    public function addforumAction()
    {
        // action body
      $data = $this->getRequest()->getParams();

      $this->view->listcat = $this->category->getCategories();
      $form = new Application_Form_Forum();

      if ($this->getRequest()->isPost()) {
          $this->forum->addForums($data);
      }
      $this->view->form = $form;
    }

    public function listforumsAction()
    {
        // action body
        #$this->view->categories = $this->category->getCategories();
        $this->view->forums = $this->forum->listForums();
        $this->view->spec = $this->forum->getSpecForum();
        #var_dump($forums);
    }

    public function deleteforumAction()
    {
        // action body
        $id = $this->getRequest()->getParam('id');
        if (isset($id)) {
            # code...
          $this->forum->deleteForum($id);
            $this->redirect('/forum/listforums');
        }
    }

    public function editforumAction()
    {
        // action body
        $id = $this->getRequest()->getParam('id');
        //we have two option whether he pushed the button with the data or without the data
        if ($this->getRequest()->isGet()) {
            if (isset($id)) {
                # code...
            $forumData = $this->forum->getForumById($id);
                $editform = new Application_Form_Forum();
            //populate her to push the array into the form
            $editform->populate($forumData[0]);
                $this->view->form = $editform;
                $this->view->newId = $id;
            }
        } else {
            $data = $this->getRequest()->getParams();
            if ($this->getRequest()->isPost()) {
                # code...
            $this->forum->editForums($id, $data);
            }
            $this->redirect('/forum/listforums');
        }
    }
}
