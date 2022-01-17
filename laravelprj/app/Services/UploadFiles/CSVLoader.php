<?php
namespace App\Services\UploadFiles;

use App\Services\Interfaces\ConsoleService;

class CSVLoader implements ConsoleService {
    private array $headers;//set when calculate data ar
    private array $data;    
    public function __construct($path) {
        $fileObj = $this->setData($path, 'r');
        $this->data = $this->formateData($fileObj);
    }    
    private function setData($path)
    {
        $fileObj = fopen($path, 'r');
        return $fileObj;
    }
    private function formateData($fileObj)
    {        
        $firstLine = true;
        while (($line = fgetcsv($fileObj)) !== FALSE) {            
            $curStr = $line[0];            
            $curArLine = explode(",", $curStr);
            if($firstLine){
                $this->headers = $curArLine;
                $firstLine = false;
            } else {            
                $data[] = $curArLine;
            }
        }
        fclose($fileObj);
        return  $data;
    }
    public function getHeaders() : array
    {
        return $this->headers;
    }
    public function getData() : array
    {
        return $this->data;
    }
}