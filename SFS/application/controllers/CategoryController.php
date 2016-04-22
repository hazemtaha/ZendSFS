<?php
class CategoryController extends Zend_Controller_Action
{

    public function init()
    {
		/* Initialize action controller here */
		//initalize our model at the begining
		$this->model = new Application_Model_DbTable_Category();
        Zend_Loader::loadFile('Auth.php', APPLICATION_PATH.'/../library/utils/', true);
        $authSystem = new Auth();
        if (!$authSystem->isAdmin()) {
            $this->renderScript('404.phtml');
        }
    }

    public function indexAction()
    {
		// action body
    }

    public function addcategoryAction()
    {
		// action body
		// adding our action we have to get the request info
		$data = $this->getRequest()->getParams();

		$form = new Application_Form_Category();

		if ($this->getRequest()->isPost()) {
		    $this->model->addCategory($data);
		}

		    $this->view->form = $form;

    }

    public function listcategoriesAction()
    {
        // action body
        $this->view->listcat = $this->model->getCategories();
    }

    public function deletecategoriesAction()
    {
        // action body
        $id=$this->getRequest()->getParam('id');
        if (isset($id)) {
          # code...
          $this->model->deleteCategories($id);
          $this->redirect('/category/listcategories');
        }
    }

    public function editcategoriesAction()
    {
        // action body
        $id = $this->getRequest()->getParam('id');
        //we have two option whether he pushed the button with the data or without the data
        if ($this->getRequest()->isGet()){
          if (isset($id)) {
            # code...
            $categoryData = $this->model->getCatsById($id);
            $editform = new Application_Form_Category();
            //populate her to push the array into the form
            $editform->populate($categoryData[0]);
            $this->view->form = $editform;
            $this->view->newId = $id;
          }
        }else{
          $data = $this->getRequest()->getParams();
          if ($this->getRequest()->isPost()) {
            # code...
            $this->model->editCategories($id,$data);
          }
          $this->redirect('/category/listcategories');
        }
    }


}
