<?php


namespace App\Http\Classes\ExtractData;


class FileDataExtract implements DataExtract
{
    protected $dataFile;

    public function __construct()
    {
        $this->dataFile = file_get_contents(__DIR__."/../../../../../data-1.json");
        $this->dataFile = json_decode($this->dataFile);
    }

    public function getData()
    {
        $data = $this->dataFile;
        $data = array_map(function($record){
            $record->Precio = str_replace('$', '', $record->Precio);
            $record->Precio = (int) str_replace(',', '', $record->Precio);
            return $record;
        }, $data);
        return $data;
    }

    public function filtersFromData()
    {
        $filters=[];

        $filters['ciudad']=$this->getArrayToFilters('Ciudad');
        $filters['tipo']=$this->getArrayToFilters('Tipo');
        $filters['precio']=$this->getArrayToFilters('Precio');

        return $filters;
    }

    public function filterData(array $arrayToFilter, $column, $value)
    {
        if(is_null($value) || $value ==""){
            return $arrayToFilter;
        }
        return array_filter($arrayToFilter, function ($record) use ($column, $value){
            $values = explode(';', $value);
            if(count($values)>=2){
                return $values[0] <= $record->{$column} && $record->{$column}<= $values[1];
            }else{
                return $record->{$column} == $values[0];
            }

        });
    }

    private function getArrayToFilters($column){
        $filters=[];
        array_map(function ($record) use (&$filters, $column){
            $value = $record->{$column};
            if(!in_array($value,$filters)){
                $filters[]=$value;
            }
        }, $this->dataFile);
        sort($filters);
        return  $filters;
    }
}