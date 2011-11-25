<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Moris
 * Date: 25.11.11
 * Time: 22:12
 * To change this template use File | Settings | File Templates.
 */

class TM_FileManager_Folder extends TM_FileManager_File
{

    public function __construct($path, $name = '')
    {
        $this->_path = $path;
        $this->_name = $name;
    }

    /**
     *
     *
     * @param string $name

     * @return string
     * @access public
     */
    public function download($name)
    {
        $this->_name = $name;
        $result = mkdir($this->_path . '/' . $this->_name, 0766);
        if ($result) {
            return $this->_name;
        } else {
            throw new Exception('Can not upload file');
        }
    }

    /**
     *
     *
     * @return void
     * @access public
     */
    public function delete() {
        if (!empty($this->_name) && file_exists($this->_path . '/' . $this->_name)) {
            $result = rmdir($this->_path . '/' . $this->_name);
            if ($result === false) {
                throw new Exception('Can not delete folder ' . $this->_name);
            }
        }
    }

}
