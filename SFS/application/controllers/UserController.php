<?php

class UserController extends Zend_Controller_Action
{
	private $user;
    public function init()
    {
        $this->user = new Application_Model_DbTable_User();
    }

    public function indexAction()
    {
        // action body
    }

    public function loginAction()
    {
        $reqParams = $this->getRequest()->getParams();
        $form = new Application_Form_Login();
        $db = Zend_Db_Table::getDefaultAdapter();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($reqParams)) {
                $authAdapter = new Zend_Auth_Adapter_DbTable($db, 'users', 'username', 'password');
                $authAdapter->setIdentity($reqParams['username']);
                $authAdapter->setCredential(md5($reqParams['password']));
                $result = $authAdapter->authenticate();
                if ($result->isValid()) {
                    $auth = Zend_Auth::getInstance();
                    $storage = $auth->getStorage();
                    $storage->write($authAdapter->getResultRowObject(array('u_id', 'username', 'email', 'is_admin', 'gender', 'country', 'picture')));
                    $this->redirect('/forum/list');
                } else {
                    $error = 'Sorry ivalid username or password';
                    $this->view->error = $error;
                }
            }
        }
        $this->view->form = $form;
    }

    public function logoutAction()
    {
        $user = Zend_Auth::getInstance();
        $user->clearIdentity();
        $this->redirect('/user/login');
    }

    public function signupAction()
    {
        $reqParams = $this->getRequest()->getParams();
        $form = new Application_Form_Register();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($reqParams)) {
            	// $upload = new Zend_File_Transfer_Adapter_Http();    
       			// $upload->setDestination('/var/www/html/ZendSFS/SFS/public/user-uploads/');
       			$form->getElement('picture')->addFilter('Rename', array(
       				'target' => $form->getValue('username')."_".$form->getValue('picture'),
       				'overwrite' => true
       				));
       			if ($form->getElement('picture')->receive()) {
         			$reqParams['picture'] = $form->getElement('picture')->getValue();
	                if ($this->user->addUser($reqParams)) {
	                    $this->redirect('user/login');
	                }
       			}
            }
        }
        $this->view->form = $form;
    }


}







