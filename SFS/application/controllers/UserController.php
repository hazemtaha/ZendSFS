<?php

class UserController extends Zend_Controller_Action
{
    private $user = null,$system,$authSystem;

    public function init()
    {
        $this->user = new Application_Model_DbTable_User();
        Zend_Loader::loadFile('SystemStatus.php', APPLICATION_PATH.'/../library/utils/', true);
        Zend_Loader::loadFile('Auth.php', APPLICATION_PATH.'/../library/utils/', true);
        $this->system = new SystemStatus();
        $this->authSystem = new Auth();
        $user = Zend_Auth::getInstance();
        if (!$user->hasIdentity()) {
            if ($this->getRequest()->getActionName() != 'login') {
                if ($this->getRequest()->getActionName() != 'signup') {
                    $this->renderScript('404.phtml');
                }
            }
        }
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
                    $user = $authAdapter->getResultRowObject();
                    $auth = Zend_Auth::getInstance();
                    $storage = $auth->getStorage();
                    if ($this->system->checkSystemAvailablitiy()) {
                        $storage->write($authAdapter->getResultRowObject(array('u_id', 'username', 'email', 'is_admin', 'is_active', 'gender', 'country', 'picture')));
                        $this->redirect('/forum/list');
                    } else {
                        if ($user->is_admin) {
                            $storage->write($authAdapter->getResultRowObject(array('u_id', 'username', 'email', 'is_admin', 'is_active', 'gender', 'country', 'picture')));
                            $this->redirect('/forum/list');
                        } else {
                            $error = 'Sorry, Site is currently offline, Check again later';
                            $this->view->error = $error;
                        }
                    }
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
        $auth = Zend_Auth::getInstance();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($reqParams)) {
                // $upload = new Zend_File_Transfer_Adapter_Http();
                   // $upload->setDestination('/var/www/html/ZendSFS/SFS/public/user-uploads/');
                   $form->getElement('picture')->addFilter('Rename', array(
                       'target' => $form->getValue('username').'_'.$form->getValue('picture'),
                       'overwrite' => true,
                       ));
                if ($form->getElement('picture')->receive()) {
                    $reqParams['picture'] = $form->getElement('picture')->getValue();
                    if ($this->user->addUser($reqParams)) {
                        if ($auth->getIdentity()->is_admin) {
                            $this->redirect('user/admin-list-user');
                        }
                        $mail = new Zend_Mail();
              //information of user login to send message in your  mail
              $name = $reqParams['username'];
                        $email = $reqParams['email'];
                        $mail->setBodyText('hi'.$name.'<br>'.'Welcome in our Forums  your Email '.$email.'to verify your account please click this link  http://localhost/ZendSFS/SFS/public/user/verify/username/'.$name);
                        $mail->setFrom('admin@forum.com', 'Forum');
                        $mail->addTo($email, 'Me');
                        $mail->setSubject('verify your account');
                        $mail->send();
                        $this->redirect('user/login');
                    }
                }
            }
        }
        $this->view->form = $form;
    }

    public function adminListUserAction()
    {
        if ($this->authSystem->isAdmin()) {
            $users = $this->user->listUser();
            if (isset($users)) {
                $paginator = Zend_Paginator::factory($users);
                $paginator->setItemCountPerPage(5);
                $paginator->setCurrentPageNumber($this->getRequest()->getParam('page'));
                $this->view->paginator = $paginator;
                Zend_Paginator::setDefaultScrollingStyle('Sliding');
                Zend_View_Helper_PaginationControl::setDefaultViewPartial('thread/_pagination.phtml');
            }
        } else {
            $this->renderScript('404.phtml');
        }
    }

    public function adminEditUserAction()
    {
        if ($this->authSystem->isAdmin()) {
            $id = $this->getRequest()->getParam('id');
            $reqParams = $this->getRequest()->getParams();
            $form = new Application_Form_Register();
            if ($this->getRequest()->isPost()) {
                $form->getElement('picture')->addFilter('Rename',
                array('target' => $form->getValue('username').'_'.$form->getValue('picture'),
                'overwrite' => true, ));
                if ($form->getElement('picture')->receive()) {
                    $reqParams['picture'] = $form->getElement('picture')->getValue();
                    $this->user->editUser($reqParams, $id);
                }
                $this->redirect('/user/admin-list-user');
            }
            $user = $this->user->getUserById($id);
            $form->populate($user[0]);
            $this->view->form = $form;
            $this->render('signup');
        } else {
            $this->renderScript('404.phtml');
        }
    }

    public function adminDeleteUserAction()
    {
        if ($this->authSystem->isAdmin()) {
            if ($this->getRequest()->isPost()) {
                $id = $this->getRequest()->getParam('id');
                if ($id) {
                    $this->user->deleteUser($id);
                }
            }
        } else {
            $this->renderScript('404.phtml');
        }
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function adminBanUserAction()
    {
        if ($this->authSystem->isAdmin()) {
            if ($this->getRequest()->isPost()) {
                $id = $this->getRequest()->getParam('id');
                if ($id) {
                    $user = $this->user->getUserById($id);
                    $isActive = $user[0]['is_active'];
                    $this->user->banUser($id, $isActive);
                }
            }
        } else {
            $this->renderScript('404.phtml');
        }
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }
    public function makeAdminAction()
    {
        if ($this->authSystem->isAdmin()) {
            if ($this->getRequest()->isPost()) {
                $id = $this->getRequest()->getParam('id');
                if ($id) {
                    $user = $this->user->getUserById($id);
                    $isAdmin = $user[0]['is_admin'];
                    $this->user->adminUser($id, $isAdmin);
                }
            }
        } else {
            $this->renderScript('404.phtml');
        }
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function adminSearchUserAction()
    {
        if ($this->authSystem->isAdmin()) {
            $username = $this->getRequest()->getParam('value');
            if ($username) {
                $users = $this->user->searchUser($username);
                if (isset($users)) {
                    $paginator = Zend_Paginator::factory($users);
                    $paginator->setItemCountPerPage(5);
                    $paginator->setCurrentPageNumber($this->getRequest()->getParam('page'));
                    $this->view->paginator = $paginator;
                    Zend_Paginator::setDefaultScrollingStyle('Sliding');
                    Zend_View_Helper_PaginationControl::setDefaultViewPartial('thread/_pagination.phtml');
                    $this->_helper->layout->disableLayout();
                    $this->_helper->viewRenderer->setNoRender(true);
                }
            }
        } else {
            $this->renderScript('404.phtml');
        }
    }

    public function updateuserAction()
    {
        $id = $this->getRequest()->getParam('id');
        $reqParams = $this->getRequest()->getParams();
        $form = new Application_Form_Register();

        if ($this->getRequest()->isPost()) {
            //Despite all of these we have a null picture in our array
                $form->getElement('picture')->addFilter('Rename',
                array('target' => $form->getValue('username').'_'.$form->getValue('picture'),
                'overwrite' => true, ));
            if ($form->getElement('picture')->receive()) {
                $reqParams['picture']=$form->getElement('picture')->getValue();
                $this->user->editUser($reqParams, $id);
            }
            $this->redirect('/forum/list');
        }

        $user = $this->user->getUserById($id);
        $image = $user[0]['picture'];
        $form->populate($user[0]);
        $this->view->form = $form;
        $this->render('signup');
    }

    public function verify()
    {
        $username = $this->getRequest()->getParam('username');
        if ($username) {
            $this->user->verify($username);
            $this->redirect('user/login');
        }
    }
}
