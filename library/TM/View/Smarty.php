<?php

/**
 * Smarty render adapter
 * @author Nikolay Ermin (nikolay@ermin.ru)
 * @link http://siteforever.ru
 */

require_once 'Smarty/Smarty.class.php';

class TM_View_Smarty extends Zend_View_Abstract
{

    /**
     * Smarty Object
     * @var Smarty
     */
    protected $_smarty;


    function __construct()
    {
        $this->_smarty = new Smarty();
    }

    /**
     * Processes a view script and returns the output.
     *
     * @param string $name The script name to process.
     * @return string The script output.
     */
    public function render($name)
    {
        header('Content-Type: text/html; charset=' . Zend_Registry::get('production')->smarty->encoding);
        return $this->_smarty->fetch($name);
    }

    /**
     * Clear all assigned variables
     *
     * Clears all variables assigned to Zend_View either via {@link assign()} or
     * property overloading ({@link __get()}/{@link __set()}).
     *
     * @return void
     */
    public function clearVars()
    {
        $this->_smarty->clearAllAssign();
    }

    /**
     * Assign variables to the view script via differing strategies.
     *
     * Suggested implementation is to allow setting a specific key to the
     * specified value, OR passing an array of key => value pairs to set en
     * masse.
     *
     * @see __set()
     * @param string|array $spec The assignment strategy to use (key or array of key
     * => value pairs)
     * @param mixed $value (Optional) If assigning a named variable, use this
     * as the value.
     * @return void
     */
    public function assign($spec, $value = null)
    {
        if (is_array($spec)) {
            $this->_smarty->assign($spec);
            return;
        }
        $this->_smarty->assign($spec, $value);
    }

    /**
     * Allows unset() on object properties to work
     *
     * @param string $key
     * @return void
     */
    public function __unset($key)
    {
        $this->_smarty->clearAssign($key);
    }

    /**
     * Allows testing with empty() and isset() to work
     *
     * @param string $key
     * @return boolean
     */
    public function __isset($key)
    {
        return (null !== $this->_smarty->getTemplateVars($key));
    }

    /**
     * Assign a variable to the view
     *
     * @param string $key The variable name.
     * @param mixed $val The variable value.
     * @return void
     */
    public function __set($key, $val)
    {
        $this->_smarty->assign($key, $val);
    }

    /**
     * Add an additional path to view resources
     *
     * @param string $path
     * @param string $classPrefix
     * @return void
     */
    public function addBasePath($path, $classPrefix = 'Zend_View')
    {
        $this->_smarty->addTemplateDir($path);
    }

    /**
     * Set a base path to all view resources
     *
     * @param string $path
     * @param string $classPrefix
     * @return void
     */
    public function setBasePath($path, $classPrefix = 'Zend_View')
    {
        $this->_smarty->setTemplateDir($path);
    }

    /**
     * Retrieve all view script paths
     *
     * @return array
     */
    public function getScriptPaths()
    {
        if (is_array($this->_smarty->template_dir)) {
            return $this->_smarty->template_dir;
        }
        return array($this->_smarty->template_dir);
    }

    /**
     * Set the path to find the view script used by render()
     *
     * @param string|array The directory (-ies) to set as the path. Note that
     * the concrete view implentation may not necessarily support multiple
     * directories.
     * @return void
     */
    public function setScriptPath($path)
    {
        if (is_readable($path)) {
            $this->_smarty->setTemplateDir($path);
            return;
        }
        throw new Exception('Invalid path provided "' . $path . '"');
    }

    /**
     * Set the path for compiled templates
     * @param $path
     * @return void
     */
    public function setCompilePath($path)
    {
        $this->_smarty->compile_dir = $path;
    }

    /**
     * Get the path for compiled templates
     * @return null|string
     */
    public function getCompilePath()
    {
        return $this->_smarty->compile_dir;
    }

    /**
     * Set the path for custom plugins
     * @param $path
     * @return void
     */
    public function addPluginsPath($path)
    {
        if (is_null($this->_smarty->plugins_dir)) {
            $this->_smarty->plugins_dir = array($path);
        } else {
            $this->_smarty->plugins_dir[] = $path;
        }
    }

    /**
     * Return the template engine object, if any
     *
     * If using a third-party template engine, such as Smarty, patTemplate,
     * phplib, etc, return the template engine object. Useful for calling
     * methods on these objects, such as for setting filters, modifiers, etc.
     *
     * @return Smarty
     */
    public function getEngine()
    {
        return $this->_smarty;
    }
        

    /**
     * Use to include the view script in a scope that only allows public
     * members.
     *
     * @return mixed
     */
    protected function _run()
    {
        include func_get_arg(0);
    }

}

?>
