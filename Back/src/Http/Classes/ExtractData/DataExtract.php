<?php
namespace App\Http\Classes\ExtractData;

interface DataExtract
{
    public function getData();

    public function filtersFromData();

    public function filterData(array $array, $column, $value);
}