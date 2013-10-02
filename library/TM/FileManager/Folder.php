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

    /**
     * @param string $path
     * @param string $name
     */
    public function __construct($path, $name = '')
    {
        $this->_path = $path;
        $this->_name = $name;
    }

    /**
     * @param string $name - название папки
     * @return string
     * @throws Exception
     */
    public function download($name)
    {
        $this->_name = $name;

        if (file_exists($this->_path . $this->_subPath . '/' . $this->_name)) {
            return $this->_name;
        }
        $result = mkdir($this->_path . $this->_subPath . '/' . $this->_name, 0766);
        if ($result) {
            return $this->_name;
        } else {
            throw new Exception('Can not create folder');
        }
    }

    /**
     *
     *
     * @throws Exception
     * @return void
     */
    public function delete()
    {
        if (!empty($this->_name) && file_exists($this->_path . $this->_subPath . '/' . $this->_name)) {
            $result = rmdir($this->_path . $this->_subPath . '/' . $this->_name);
            if ($result === false) {
                throw new Exception('Can not delete folder ' . $this->_subPath . '/' . $this->_name);
            }
        }
    }

    public function move($to)
    {
        if (!empty($to)) {
            $result = rename($this->_path . $this->_subPath . '/' . $this->_name, $to);
            if ($result === false) {
                throw new Exception('Can not move folder from ' . $this->_subPath . '/' . $this->_name . ' to ' . $to);
            }
        }

    }

}
