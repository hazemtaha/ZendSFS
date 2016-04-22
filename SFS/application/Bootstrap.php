<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
  protected function _initDoctype()
  {
      $this->bootstrap('view');
      $view = $this->getResource('view');
      $view->doctype('XHTML1_STRICT');
      $view->headMeta()->appendName('keywords', 'forum, zend')->appendHttpEquiv('Content-Type', 'text/html;charset=utf-8');
      $view->headTitle('SFS')->setSeparator(' :: ');
      // Set the initial stylesheet:
      $view->headLink()->prependStylesheet('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');
      // Set the initial JS to load:
      $view->headScript()->prependFile('https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js');
      $view->headScript()->appendFile('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js');
  }
  protected function _initSession()
  {
      Zend_Session::start();
      $session = new Zend_Session_Namespace('Zend_Auth');
      $session->setExpirationSeconds(1800);
  }
  protected function _initNavigationConfig()
  {
      $this->bootstrap('layout');
      $layout = $this->getResource('layout');
      $view = $layout->getView();
      $config = new Zend_Config_Xml(APPLICATION_PATH.'/configs/navigation.xml');
      $navigation = new Zend_Navigation($config);
      $view->navigation($navigation);
  }
  protected function _initSystemStatus() {
      Zend_Loader::loadFile("SystemStatus.php", APPLICATION_PATH."/../library/utils/", true);
      $system = new SystemStatus();
      $router = new Zend_Controller_Router_Rewrite();
      $request = new Zend_Controller_Request_Http();
      $router->route($request);        
      $frontController = Zend_Controller_Front::getInstance();
      $isAdmin = false;
      if (!$system->checkSystemAvailablitiy()) {
        $user = Zend_Auth::getInstance();
        if ($user->hasIdentity()) {
          $userObj = $user->getIdentity();
          if ($userObj->is_admin) {
            $isAdmin = true;
          }
        }
        if ($request->getActionName() != 'login' && !$isAdmin) {
          $response = new Zend_Controller_Response_Http();
          $response->setRedirect($frontController->getBaseUrl()."/ZendSFS/SFS/public/user/login");
          $frontController->setResponse($response);
        }
      }
  }
}
