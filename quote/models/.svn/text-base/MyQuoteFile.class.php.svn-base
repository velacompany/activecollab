<?php
/**
 * Created by PhpStorm.
 * User: trisatria
 * Date: 12/6/13
 * Time: 11:51 AM
 */

class MyQuoteFile {

    protected $fileName;
    protected $mineType;
    protected $path;
    protected $tmpName;
    protected $size;

    //getter
    function getFileName(){return $this->fileName;}
    function getMineType(){return $this->mineType; }
    function getPath(){return $this->path;}
    function getTmpName(){return $this->tmpName;}
    function getSize(){return $this->size;}


    //setter
    function setFileName($value){ $this->fileName = $value; }
    function setMintype($value){$this->mineType = $value; }
    function setFilePath($value){$this->path = $value; }
    function setSize($value){$this->size = $value; }

    //construct
    function  MyQuoteFile($file = array()){
        $this->fileName = time().$file['name'];
        $this->mineType = $file['type'];
        $this->path = UPLOAD_PATH;
        $this->tmpName = $file['tmp_name'];
        $this->size = $file['size'];
    }

    //function
    function Upload(){
        $status = array();
        if(move_uploaded_file($this->tmpName, $this->path.'/'.$this->fileName)){
            $file_path = $this->path.'/'.$this->fileName;
             $status['file_path'] = $file_path;
            $status['file_name'] = $this->fileName;
            $status['status'] = true;
        }
        else{
            $status['status'] = false;
        }
        return $status;
    }
    /**
     * Return download file url
     *
     * @return string
     */
    function getDownloadUrl($force = false) {
        if ($this->getType() == 'file') {
            $params = array(
                'document_id' => $this->getId(),
            );

            if ($force) {
                $params['disposition'] = 'attachment';
                $params['force'] = 1;
            } // if

            return Router::assemble('document_download', $params);
        } else {
            return $this->getViewUrl();
        } // if
    } // getDownloadUrl




}