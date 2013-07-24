<?php

/**
 * class File
 *
 */
class TM_FileManager_File
{
    /**
     *
     * @access protected
     */
    protected $_name;

    /**
     *
     * @access protected
     */
    protected $_path;

    /**
     * @var string
     */
    protected $_subPath = '';

    /**
     *
     * @access protected
     */
    protected $_ext;

    /**
     *
     * @access protected
     */
    protected $_tempPath;

    /**
     *
     * @access protected
     */
    protected $_size;

    /**
     * Оригинальное название файла при загрузке
     *
     * @var string
     */
    protected $_originalName = '';

    /**
     *
     *
     * @return string
     * @access public
     */
    public function getName()
    {
        return $this->_name;
    }

    public function setName($value)
    {
        $this->_name = $value;
        $this->_ext = $this->extractExt($value);
    }

    public function getPath()
    {
        return $this->_path;
    }

    public function setSubPath($folder)
    {
        $this->_subPath = $folder;
    }

    public function getSubPath()
    {
        return $this->_subPath;
    }

    /**
     * @return string
     */
    public function getOriginalName()
    {
        return $this->_originalName;
    }

    /**
     *
     *
     * @param string $path
     * @param string $name
     *
     * @return TM_FileManager_File
     * @access public
     */
    public function __construct($path, $name = '')
    {
        $this->_path = $path;
        $this->_name = $name;

        if (!empty($this->_name)) {
            $this->_ext = $this->extractExt($this->_name);
        }
    }

    /**
     *
     *
     * @param string $field
     *
     * @throws Exception
     * @return string
     * @access public
     */
    public function download($field)
    {
        if (isset($_FILES[$field]) && $_FILES[$field]['error'] == 0) {
            $this->_ext = $this->extractExt($_FILES[$field]['name']);
            $tempFileName = 'file_' . date('d-m-Y-H-i-s') . '.' . $this->_ext;
            $result = copy($_FILES[$field]['tmp_name'], $this->_path . $this->_subPath . '/' . $tempFileName);

            if ($result) {
                chmod($this->_path . $this->_subPath . '/' . $tempFileName, 0766);
                $this->_name = $tempFileName;
                $this->_originalName = $this->extractName($_FILES[$field]['name']);
                return $this->_name;
            } else {
                throw new Exception('Can not upload file ' . $this->_path . $this->_subPath . '/' . $tempFileName . ' res ' . $result);
            }
        } else {
            return false;
        }
    }

    /**
     *
     *
     * @throws Exception
     * @return void
     * @access public
     */
    public function delete()
    {
        if (!empty($this->_name) && file_exists($this->_path . $this->_subPath . '/' . $this->_name)) {
            $result = unlink($this->_path . $this->_subPath . '/' . $this->_name);
            if ($result === false) {
                throw new Exception('Can not delete file ' . $this->_name);
            }
        }
    }

    /**
     * Возвращает расширение файла
     *
     * @param string $name
     *
     * @return string
     * @access protected
     */
    protected function extractExt($name)
    {
        if (!empty($name)) {
            $tempInfo = pathinfo($name);
            return $tempInfo['extension'];
        } else {
            return '';
        }
    }

    /**
     * Возвращает имя файла без расширения
     *
     * @param string $name
     *
     * @return string
     */
    protected function extractName($name)
    {
        if (!empty($name)) {
            $tempInfo = pathinfo($name);
            return $tempInfo['filename'];
        } else {
            return '';
        }
    }

    /**
     * Проверяем наличие файла для загрузки
     *
     * @param $field
     *
     * @return bool
     */
    public static function hasFileForUpload($field)
    {
        if (isset($_FILES[$field]) && $_FILES[$field]['error'] == 0) {
            return true;
        } else {
            return false;
        }
    }
}