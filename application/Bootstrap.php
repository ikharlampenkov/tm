<?php

require_once 'StdLib/Smarty.php';

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    /**
     * Инициализация вида со смарти
     * @return StdLib_Smarty
     */
    protected function _initView()
    {
        // создаем вид
        $view = new StdLib_Smarty();

        //$view->getEngine()->debugging = true;

        $view->assign('this', $view);

        $options = $this->getOptions();

        // Устанавливаем пути
        $view->setBasePath($options['resources']['view']['viewPath']);
        $view->setCompilePath($options['resources']['view']['viewCompilePath']);

        if (isset($options['resources']['view']['pluginsPath'])) {
            $view->addPluginsPath($options['resources']['view']['pluginsPath']);

        }

        $view->setEncoding($options['resources']['view']['encoding']);

        // Создаем рендер
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');

        // Настраиваем рендер
        $viewRenderer->setView($view)
                ->setViewBasePathSpec($view->getEngine()->template_dir)
                ->setViewScriptPathSpec(':controller/:action.:suffix')
                ->setViewScriptPathNoControllerSpec(':action.:suffix')
                ->setViewSuffix($options['resources']['view']['viewSuffix']);

        $view->assign('title', $options['tm']['title']);
        $view->assign('description', $options['smarty']['default']['desc']);
        $view->assign('keywords', $options['smarty']['default']['keyword']);
        $view->assign('encoding', $options['smarty']['encoding']);

        //print_r($view);

        return $view;
    }

    /**
     * Инициализация лэйаута при работе со смарти
     * @throws Zend_Application_Bootstrap_Exception
     * @return Zend_Layout
     */
    protected function _initLayout()
    {
        // Обеспечиваем наличие View
        $this->bootstrap('View');

        // Получаем ссылку на View
        $view = $this->getResource('View');

        // Получаем опции
        $options = $this->getOptions();

        // добавляем в смарти путь к лэйаутам
        $view->addBasePath($options['resources']['layout']['layoutPath']);

        // Инициализируем лэйаут
        Zend_Layout::startMvc($this->getOptions());
        $layout = Zend_Layout::getMvcInstance();

        $layout->setViewSuffix($options['resources']['layout']['layoutSuffix']);
        $layout->setView($view);
        $view->layout = $layout;

        return $layout;
    }

    protected function _initAutoLoader()
    {
        $auto = Zend_Loader_Autoloader::getInstance();
        $auto->registerNamespace('TM');
        $auto->registerNamespace('StdLib');
    }

    protected function _initConfig()
    {
        Zend_Registry::set('production', new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', 'production'));
    }

    protected function _initLog()
    {
        // Получаем опции
        $options = $this->getOptions();

        $o_log = new StdLib_Log();
        $o_log->setLogLevel($options['log']['level']);

        $db = StdLib_DB::getInstance();
        $db->debug = $options['db']['debug'];
    }

    protected function _initAuth()
    {
        $auth = Zend_Auth::getInstance();
        $data = $auth->getStorage()->read();

        if (!isset($data->role)) {
            $storage_data = new stdClass();
            $storage_data->id = 0;
            $storage_data->login = 'guest';
            $storage_data->token = '';
            $storage_data->role = 'guest';
            $auth->getStorage()->write($storage_data);

            $view = $this->getResource('View');
            $view->assign('authUser', 'Гость');
        } else {
            $view = $this->getResource('View');

            if ($data->id != 0) {
                $oUser = TM_User_User::getInstanceById($data->id);
                if ($oUser->searchAttribute('name')) {
                    $view->assign('authUser', $oUser->getAttribute('name')->value);
                } else {
                    $view->assign('authUser', $data->login);
                }
            } else {
                $view->assign('authUser', $data->login);

            }
        }
    }

    protected
    function _initAcl()
    {
        Zend_Loader::loadClass('TM_Acl_Acl');
        Zend_Loader::loadClass('CheckAccess');
        Zend_Controller_Front::getInstance()->registerPlugin(new CheckAccess());

        $view = $this->getResource('View');
        $view->getEngine()->loadPlugin('smarty_block_if_allowed');
        $view->getEngine()->loadPlugin('smarty_block_if_object_allowed');

        return new TM_Acl_Acl();
    }

    protected
    function _initViewParam()
    {
        Zend_Loader::loadClass('SetViewParam');
        Zend_Controller_Front::getInstance()->registerPlugin(new SetViewParam());
    }


}

