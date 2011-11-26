<?php

/**
 * class Image
 *
 */
class TM_FileManager_Image extends TM_FileManager_File {
    /** Aggregations: */

    /** Compositions: */
    /*     * * Attributes: ** */

    protected $_extList = array('gif', 'jpg', 'jpeg', 'png');

    /**
     *
     *
     * @param string field

     * @return string
     * @access public
     */
    public function download($field) {
        //print_r($_FILES[$field]);
        if (isset($_FILES[$field]) && $_FILES[$field]['error'] == 0) {
            $this->_ext = $this->extractExt($_FILES[$field]['name']);

            if (!in_array($this->_ext, $this->_extList)) {
                throw new Exception('Bad extension');
            }

            $tempFileName = 'img_' . date('d-m-Y-H-i-s') . '.' . $this->_ext;
            $result = copy($_FILES[$field]['tmp_name'], $this->_path . $this->_subPath . '/' . $tempFileName);

            if ($result) {
                chmod($this->_path . $this->_subPath . '/' . $tempFileName, 0766);
                $this->_name = $tempFileName;
                //$this->createPreview();
                return $this->_name;
            } else {
                throw new Exception('Can not upload file');
            }
        } else {
            return false;
        }
    }

// end of member function download

    /**
     *
     *
     * @param int size

     * @return
     * @access public
     */
    public function createPreview($size = 100) {
        $image = $this->_getImageByType();
        list($oldxsize, $oldysize) = getimagesize($this->_path . $this->_subPath . '/' . $this->_name);
        $newxsize = $oldxsize;
        $newysize = $oldysize;
//    echo 'X=' . $newxsize . '   Y=' . $newysize. '<br>';
        if ($newxsize > $size) {
            $newysize = $newysize * $size / $newxsize;
            $newxsize = $size;
        }
        if ($newysize > $size) {
            $newxsize = $newxsize * $size / $newysize;
            $newysize = $size;
        }
        $imagePrew = imagecreatetruecolor($newxsize, $newysize);
        $result = imagecopyresampled($imagePrew, $image, 0, 0, 0, 0, $newxsize, $newysize, $oldxsize, $oldysize);
        if ($result) {
            $this->_savePreviewFile($imagePrew);
            chmod($this->_path . $this->_subPath . '/' . $this->getPreview(), 0666);
        } else {
            throw new Exception('Can not create preview for file ' . $this->_name);
        }
    }

// end of member function createPreview

    /**
     *
     *
     * @return
     * @access public
     */
    public function delete() {
        if (!empty($this->_name)) {
            if (file_exists($this->_path . $this->_subPath . '/' . $this->getPreview())) {
                unlink($this->_path . $this->_subPath . '/' . $this->getPreview());
            }
            parent::delete();
        }
    }

// end of member function delete

    /**
     *
     *
     * @return string
     * @access public
     */
    public function getPreview() {
        return str_replace('.', '_prew.', $this->_name);
    }

// end of member function getPreview

    private function _getImageByType() {
        switch ($this->_ext) {
            case 'gif':
                $image = imagecreatefromgif($this->_path . $this->_subPath . '/' . $this->_name);
                break;
            case 'jpeg':
                $image = imagecreatefromjpeg($this->_path . $this->_subPath . '/' . $this->_name);
                break;
            case 'jpg':
                $image = imagecreatefromjpeg($this->_path . $this->_subPath . '/' . $this->_name);
                break;
            case 'png':
                $image = imagecreatefrompng($this->_path . $this->_subPath . '/' . $this->_name);
                break;
            default:
                return false;
        }
        return $image;
    }

    private function _savePreviewFile($imagePrew) {
        switch ($this->_ext) {
            case 'gif': return imagegif($imagePrew, $this->_path . $this->_subPath . '/' . $this->getPreview());
            case 'png': return imagepng($imagePrew, $this->_path . $this->_subPath . '/' . $this->getPreview());
            case 'jpg': return imagejpeg($imagePrew, $this->_path . $this->_subPath . '/' . $this->getPreview());
            case 'jpeg': return imagejpeg($imagePrew, $this->_path . $this->_subPath . '/' . $this->getPreview());
        }
        return false;
    }

}

// end of Image
?>