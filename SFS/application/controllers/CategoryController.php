<?php
class CategoryController extends Zend_Controller_Action {

 public function init() {
		/* Initialize action controller here */
		//initalize our model at the begining
		$this->model = new Application_Model_DbTable_Category();
  }

 public function indexAction() {
		// action body
	}

 public function addcategoryAction() {
		// action body
		// adding our action we have to get the request info
		$data = $this->getRequest()->getParams();

		$form = new Application_Form_Category();

		if ($this->getRequest()->isPost()) {
		    $this->model->addCategory($data);
		}

		    $this->view->form = $form;
				
    }
 }
