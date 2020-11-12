<?php

namespace App\Http\Controllers;

use App\Http\Classes\ExtractData\FileDataExtract;
use App\Http\Response;

class BienesController
{
    protected $fileDataExtract;

    public function __construct()
    {
        $this->fileDataExtract = new FileDataExtract();
    }

    public function index(){
        $data = $this->fileDataExtract->getData();

        return responseJson($data);
    }

    public function filters(){
        $data = $this->fileDataExtract->filtersFromData();
        return responseJson($data);
    }

    public function byFilter(){
        $valuesFilter = $_GET;
        $data = $this->fileDataExtract->getData();
        foreach ($valuesFilter as $key => $value){
            $data = $this->fileDataExtract->filterData($data,$key, $value);
        }

        return responseJson($data);
    }
}