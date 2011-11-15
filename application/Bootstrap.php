<?php

require_once 'TM/View/Smarty.php';

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    /**
     * Инициализация вида со смарти
     * @return TM_View_Smarty
     */
    protected function _initView()
    {
        // создаем вид
        $view = new TM_View_Smarty();

        $view->assign('this', $view);

        $options = $this->getOptions();

        // Устанавливаем пути
        $view->setBasePath($options['resources']['view']['viewPath']);
        $view->setCompilePath($options['resources']['view']['viewCompilePath']);

        if (isset($options['resources']['view']['pluginsPath'])) {
            $view->addPluginsPath($options['resources']['view']['pluginsPath']);
        }

        // Создаем рендер
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');

        // Настраиваем рендер
        $viewRenderer->setView($view)
                ->setViewBasePathSpec($view->getEngine()->template_dir)
                ->setViewScriptPathSpec(':controller/:action.:suffix')
                ->setViewScriptPathNoControllerSpec(':action.:suffix')
                ->setViewSuffix($options['resources']['view']['viewSuffix']);

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

}

